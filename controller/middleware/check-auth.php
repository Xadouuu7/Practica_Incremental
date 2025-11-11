<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../model/pdo-usuario.php';

/**
 * Intentar asegurar que exista una sesión de usuario válida.
 * - Si ya hay $_SESSION['user'] devuelve true.
 * - Si existe cookie 'tokenInicioSesion' intenta reconstruir la sesión desde la BD.
 * - Si no se puede reconstruir, redirige al login si $redirect === true.
 *
 * @param bool $redirect Si true redirige al login y hace exit, si false devuelve false.
 * @return bool True si hay sesión válida, false si no.
 */
function require_login(bool $redirect = true): bool {
    if (!empty($_SESSION['user'])) {
        return true;
    }

    if (!empty($_COOKIE['tokenInicioSesion'])) {
        $valorToken = $_COOKIE['tokenInicioSesion'];
        $tokenHash = hash('sha512', $valorToken);

        $usuariopdo = new Usuario();
        $user = $usuariopdo->seleccionarUsuarioPorToken($tokenHash);

        if ($user !== false) {
            // Rotar token por seguridad
            $newValorToken = bin2hex(random_bytes(64));
            $newTokenHash = hash('sha512', $newValorToken);
            $expiresSeconds = 60 * 60 * 4;
            $tiempoExpiracion = time() + $expiresSeconds;
            $fechaExpiracion = date('Y-m-d H:i:s', $tiempoExpiracion);

            $usuariopdo->modificarTokenHash((int)$user['id'], $newTokenHash, $fechaExpiracion);
            setcookie('tokenInicioSesion', $newValorToken, [
                'expires' => $tiempoExpiracion,
                'path' => '/',
                'httponly' => true,
                'samesite' => 'Lax',
                // 'secure' => true,
            ]);

            session_regenerate_id(true);
            $_SESSION['user'] = $user;

            return true;
        }
    }

    if ($redirect) {
        header('Location: ../../view/login/view-login.php');
        exit;
    }

    return false;
}
