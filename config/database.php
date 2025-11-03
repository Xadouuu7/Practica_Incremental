<?php    
    require_once  "env.php";
    abstract class database  {

        private $host = DB_HOST;            // Host de la base de dades
        private $db_name = DB_NAME;         // Nom de la base de dades
        private $username = DB_USER;        // Usuari de la base de dades
        private $password = DB_PASSWORD;    // Contrasenya de la base de dades
        private $conn;                      // Connexió PDO

        /**
         * Estableix la connexió amb la base de dades.
         * @return PDO|null Retorna l'objecte PDO o null si hi ha un error.
         */
        protected function conseguirConexion() {
            $this->conn = null;
            try {
                $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $exception) {
                die("Error de connexió: " . $exception->getMessage());
            }
            return $this->conn;
        }

        /**
         * Tanca la connexió amb la base de dades.
         * @return void 
         */
        protected function cerrarConexion() {
            $this->conn = null;
        }
    }