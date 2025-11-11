<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


require_once __DIR__ . '/../../model/pdo-usuario.php';
session_start();

try {
    #if ($_SERVER['REQUEST_METHOD'] !== 'POST') { 
    #    header('Location: ../../view/login/view-login.php');
    #    exit;
    #}

    $usuario = $_POST['usuario'] ?? '';
    $contraseña = $_POST['contraseña'] ?? '';
    $recordarme = !empty($_POST['recordarme']);

    $usuariopdo = new Usuario();

    // Intento de reconstruir sesión desde cookie "recordarme"
    if (!empty($_COOKIE['tokenInicioSesion'])) {
        $valorToken = $_COOKIE['tokenInicioSesion'];
        $tokenHash = hash('sha512', $valorToken);
        $result = $usuariopdo->seleccionarUsuarioPorToken($tokenHash);

        if ($result !== false) {
            // Rotar token por seguridad
            $newValorToken = bin2hex(random_bytes(64));
            $newTokenHash = hash('sha512', $newValorToken);
            $expiresSeconds = 60 * 60 * 4;
            $tiempoExpiracion = time() + $expiresSeconds;
            $fechaExpiracion = date('Y-m-d H:i:s', $tiempoExpiracion);

            $usuariopdo->modificarTokenHash((int)$result['id'], $newTokenHash, $fechaExpiracion);
            setcookie('tokenInicioSesion', $newValorToken, [
                'expires' => $tiempoExpiracion,
                'path' => '/',
                'httponly' => true,
                'samesite' => 'Lax',
                // 'secure' => true, // activar en producción con HTTPS
            ]);

            // Regenerar id de sesión y establecer usuario
            session_regenerate_id(true);
            $_SESSION['user'] = $result;
        } else {
            // cookie inválida/expirada -> intentar autenticación normal
            $result = $usuariopdo->autenticarUsuario($usuario, $contraseña, $recordarme);
        }
    } else {
        $result = $usuariopdo->autenticarUsuario($usuario, $contraseña, $recordarme);
    }
    $_SESSION['user'] = $result;
    unset($_SESSION['login_error']);
    unset($_SESSION['ultimo_nombre_usuario']);
    unset($_SESSION['register_error']);
    unset($_SESSION['ultimo_usuario']);

    header('Location: ../../view/juego/view-juego.php');
    exit;
} catch (Exception $e) {
    $_SESSION['login_error'] = $e->getMessage();
    $_SESSION['ultimo_nombre_usuario'] = $usuario ?? '';
    header('Location: ../../view/login/view-login.php');
}

