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

            if (empty($usuario) || empty($contraseña)) {
                throw new Exception("Los parámetros usuario o contraseña están vacíos.");
            }


            $statement = $this->conn->prepare("SELECT * FROM usuario WHERE usuario = ? AND contraseña = ? LIMIT 1");
            $statement->execute([$usuario, $contraseña]);

            $result = $statement->fetch(PDO::FETCH_ASSOC);

            if ($result /*&& password_verify(password: $password, hash: $result['password'])*/) {
                return $result;
            }

            throw new Exception("Usuario o contraseña incorrectos");
        } catch (Exception $e) {
            // Mostrar el mensaje de error para depuración
            throw new Exception("Error en la autenticación: " . $e->getMessage());
        }
    }
}