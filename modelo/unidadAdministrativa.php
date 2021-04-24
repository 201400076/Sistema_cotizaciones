<?php
require_once("../configuraciones/conexion.php");
    class Unidad{
        private $modelo;
        private $conexion;
        private $conexion_activo;
        
        public function __construct()
        {
            $this->modelo = array();
            $this->conexion = new Conexion();
            $this->conexion_activo = $this->conexion->getConn();
        }
        public function register($dato){
            
            $id_facultad = $dato["id_facultad"];
            $nombre_unidad = $dato["nombre_unidad"];
            $monto_tope = 0;
            
            $stmt = $this->conexion_activo->prepare("INSERT INTO unidad_administrativa (nombre_unidad, id_facultad, monto_tope) VALUES(?,?,?)");
            $stmt->bind_param("sii", $nombre_unidad, $id_facultad, $monto_tope);
            if ($stmt->execute()) {
                return $this->conexion_activo->insert_id;
            } else {
                return 0;
            }

        }

        public function getUnidadAdministrativa(){
            $stmt = $this->conexion_activo->prepare("SELECT * FROM unidad_administrativa");
            $stmt->execute();
            $result = $stmt->get_result();
            $this->modelo = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            return $this->modelo;
        }    
    }
?>
