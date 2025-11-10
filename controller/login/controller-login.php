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
    $_SESSION['user'] = $result;
    header('Location: ../../view/juego/view-juego.php');
    exit;
} catch (Exception $e) {
    $_SESSION['login_error'] = $e->getMessage();
    $_SESSION['last_user'] = $usuario ?? '';
    header('Location: ../../view/login/view-login.php');
}


