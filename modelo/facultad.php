<?php
require_once("../configuraciones/conexion.php");
    class Facultad{
        private $modelo;
        private $conexion;
        private $conexion_activo;

        public function __construct()
        {
            $this->modelo = array();
            $this->conexion = new Conexion();
            $this->conexion_activo = $this->conexion->getConn();
        }
        public function getFacultad(){
            $stmt = $this->conexion_activo->prepare("SELECT * FROM facultad");
            $stmt->execute();
            $result = $stmt->get_result();
            $this->modelo = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            return $this->modelo;
        }
        
    }

?>