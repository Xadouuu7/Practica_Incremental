<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') { 
    header('Location: ../../view/login/view-register.php');
    exit;
}

require_once __DIR__ . '/../../model/pdo-usuario.php';
require_once __DIR__ . '/../../model/verificacion.php';
session_start();

try {
    $usuario = $_POST['usuario'] ?? '';
    $nombre = $_POST['nombre'] ?? '';
    $apellidos = $_POST['apellidos'] ?? '';
    $correo = $_POST['correo'] ?? '';
    $contraseña = $_POST['contraseña'] ?? '';
    $verificarContraseña = $_POST['verificarContraseña'] ?? '';

    $errores = [];

    if (!verificarMail($correo)) {
        $errores[] = "Correo electrónico no válido.";
    }
    if (!verificarContraseña($contraseña)) {
        $errores[] = "La contraseña no cumple con los requisitos de seguridad.";
    }
    if (!verificarUsuario($usuario)) {
        $errores[] = "El nombre de usuario no es válido.";
    }
    if (!verificarNombreApellido($nombre)) {
        $errores[] = "El nombre no es válido.";
    }
    if (!verificarNombreApellido($apellidos)) {
        $errores[] = "Los apellidos no son válidos.";
    }
    if ($contraseña !== $verificarContraseña) {
        $errores[] = "Las contraseñas no coinciden.";
    }

    if (!empty($errores)) {
        throw new Exception("Errores de validación encontrados.");
    }

    $usuariopdo = new Usuario();
    $result = $usuariopdo->registrarUsuario($usuario, $nombre, $apellidos, $correo, $contraseña, $verificarContraseña);

    if ($result) {
        unset($_SESSION['register_error']);
        header('Location: ../../view/login/view-login.php');
        exit;
    } else {
        throw new Exception("Error desconocido al registrar el usuario.");
    }
} catch (Exception $e) {
    $_SESSION['register_error'] = $errores;
    header('Location: ../../view/login/view-register.php');
    exit;
}