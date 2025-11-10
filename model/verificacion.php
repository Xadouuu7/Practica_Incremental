<?php

/**
 * Verifica el mail electrónico dado.
 * @param string $correo correo electrónico a verificar
 * @return bool true si el correo es válido, false en caso contrario
 */
function verificarMail(string $correo): bool {
    return filter_var($correo, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Verifica la contraseña tenga al menos 8 caracteres, una letra, un número y un carácter especial.
 * @param string $contraseña contraseña a verificar
 * @return bool true si la contraseña cumple con los requisitos, false en caso contrario
 */
function verificarContraseña(string $contraseña): bool {
    return preg_match('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/', $contraseña) === 1;
}
/**
 * Verifica el nombre de usuario tenga entre 3 y 20 caracteres alfanuméricos o guiones bajos.
 * @param string $usuario nombre de usuario a verificar
 * @return bool true si el nombre de usuario cumple con los requisitos, false en caso contrario
 */
function verificarUsuario(string $usuario): bool {
    return preg_match('/^[a-zA-Z0-9_]{3,20}$/', $usuario) === 1;
}

/**
 * Verifica el nombre tenga entre 1 y 50 caracteres alfabéticos o espacios.
 * @param string $nombre nombre a verificar
 * @return bool true si el nombre cumple con los requisitos, false en caso contrario
 */
function verificarNombreApellido(string $nombre): bool {
    return preg_match('/^[a-zA-ZÀ-ÿ\s]{1,50}$/', $nombre) === 1;
}