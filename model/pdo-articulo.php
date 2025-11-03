<?php
require_once  __DIR__ . '/../config/database.php';

class Articulo extends database {
    private $conn;

    /**
     * Constructor de la clase Articulo
     */
    public function __construct(){
        $this->conn = $this->conseguirConexion();
    }

    /**
     * Destructor de la clase Articulo
     * Cierra la conexión a la base de datos al destruir el objeto
     */
    public function __destruct(){
        $this->cerrarConexion();
    }

    /** 
     * Obtiene un articulo de la base de datos por su titulo
     * @param string $titulo El titulo del articulo a buscar
     * @return array|Exception Un array con los datos del articulo o null si no se encuentra
     * @throws Exception Si hay un error de base de datos
     */
    public function getArticulo(string $titulo): ?array {
        try {
            $statement = $this->conn->prepare("SELECT * FROM articulo WHERE titulo = :titulo LIMIT 1");
            $statement->execute(array(':titulo' => $titulo));
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result === false ? null : $result;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /** 
     * Obtiene todos los artículos de la base de datos indicando un límite y un offset
     * @param int $offset 
     * @param int $limite 
     * @return array|null
     */
    public function getAllArticulo(int $offset, int $limite): ?array {
        try {
            $statement = $this->conn->prepare("SELECT * FROM articulo LIMIT :limite OFFSET :offset");
            $statement->bindParam(':limite', $limite, PDO::PARAM_INT);
            $statement->bindParam(':offset', $offset, PDO::PARAM_INT);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result === false ? null : $result;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Obtiene el número total de artículos en la base de datos
     * @return int El número total de artículos
     * @throws Exception Si hay un error de base de datos
     */
    public function getNumeroArticulos(): int {
        try {
            $statement = $this->conn->prepare("SELECT COUNT(*) as total FROM articulo");
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result ? (int)$result['total'] : 0;
        } catch (Exception $e) {
            throw $e;
        }
    }
    
    /**
     * Inserta un nuevo artículo en la base de datos
     * @param string $titulo título del artículo
     * @param string $cuerpo cuerpo del artículo
     * @return string Mensaje indicando el resultado de la operación
     */
    public function insertarArticulo(string $titulo, string $cuerpo): string {
        try {
            $statement = $this->conn->prepare("INSERT INTO articulo (titulo, cuerpo) VALUES (?, ?)");
            $statement->execute(array($titulo, $cuerpo));
            return "Artículo insertado correctamente";
        } catch (Exception $e) {
            return  $e->getMessage();
        }
    }
    
    /**
     * Modifica un artículo existente en la base de datos
     * @param string $titulo título del artículo
     * @param string $cuerpo cuerpo del artículo
     */
    public function modificarArticulo(string $titulo, string $cuerpo): string {
        try {
            $statement = $this->conn->prepare("UPDATE articulo SET cuerpo = :cuerpo WHERE titulo = :titulo");
            $statement -> execute(array(':cuerpo' => $cuerpo, ':titulo' => $titulo));
            return "Artículo modificado correctamente";
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Elimina un usuario de la base de datos por su dni
     * @param string $DNI El dni del usuario a eliminar
     * @return bool True si se eliminó al menos un registro, false si no existía
     * @throws Exception Si ocurre un error de base de datos
     */
    public function eliminarArticulo(string $titulo): bool {
        try {
            $statement = $this->conn->prepare("DELETE FROM articulo WHERE titulo = :titulo");
            $statement->execute(array(':titulo' => $titulo));
            return $statement->rowCount() > 0;
        } catch (Exception $e) {
            throw $e;
        }
    }

}