<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


require_once __DIR__ . '/../../model/pdo-usuario.php';
session_start();

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') { 
        header('Location: ../../view/login/view-login.php');
        exit;
    }

    $usuario = $_POST['usuario'] ?? '';
    $contraseña = $_POST['contraseña'] ?? '';

    $usuariopdo = new Usuario();
    $result = $usuariopdo->autenticarUsuario($usuario, $contraseña);

    if ($result) {
        $_SESSION['user'] = $result;
        header('Location: ../../view/juego/view-juego.php');
        exit;
    } 

    throw new Exception("Usuario o contraseña incorrectos");
} catch (Exception $e) {
    // Mostrar el mensaje de error para depuración
    echo $e->getMessage();
}


