<?php
require_once  __DIR__ . '/../config/database.php';

class Usuario extends database {
    private $conn;

    /**
     * Constructor de la clase Usuario
     */
    public function __construct(){
        $this->conn = $this->conseguirConexion();
    }

    /**
     * Destructor de la clase Usuario
     * Cierra la conexión a la base de datos al destruir el objeto
     */
    public function __destruct(){
        $this->cerrarConexion();
    }

    /**
     * Autentica un usuario con su nombre de usuario y contraseña verificando en la base de datos
     * Comprueba si los campos no están vacíos
     * Comprueba si el usuario existe y si la contraseña coincide
     * @param string $usuario nombre del usuario
     * @param string $contraseña contraseña del usuario
     * @throws \Exception Si hay un error en la autenticación
     * @return array|Exception Los datos del usuario si la autenticación es exitosa o una excepción en caso de error
     */
    public function autenticarUsuario(string $usuario, string $contraseña): array|Exception {
        try {
            if ($usuario === '' || $contraseña === '') {
                throw new Exception("Los parámetros usuario o contraseña están vacíos.");
            }
            $statement = $this->conn->prepare("SELECT * FROM usuario WHERE usuario = ? LIMIT 1");
            $statement->execute([$usuario]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            if ($result && isset($result['contraseña']) && password_verify($contraseña, (string)$result['contraseña'])) {
                return $result;
            }

            throw new Exception("Usuario o contraseña incorrectos");
        } catch (Exception $e) {
            throw new Exception("Error en la autenticación: " . $e->getMessage());
        }
    }

    public function registrarUsuario(string $usuario, string $nombre, string $apellidos, string $correo, string $contraseña, string $verificarContraseña): bool {
        try {
            if (empty($usuario) || empty($nombre) || empty($apellidos) || empty($correo) || empty($contraseña) || empty($verificarContraseña)) {
                throw new Exception("Los parámetros usuario, nombre, apellidos, correo o contraseña están vacíos.");
            }

            if ($contraseña !== $verificarContraseña) {
                throw new Exception("Las contraseñas no coinciden.");
            }

            $hashedContraseña = password_hash($contraseña, PASSWORD_DEFAULT);
            
            $statement = $this->conn->prepare("INSERT INTO usuario (usuario, nombre, apellidos, correo, contraseña) VALUES (?, ?, ?, ?, ?)");
            $result = $statement->execute([$usuario, $nombre, $apellidos, $correo, $hashedContraseña]);

            return $result;
        } catch (Exception $e) {
            throw new Exception("Error en el registro: " . $e->getMessage());
        }
    }
}