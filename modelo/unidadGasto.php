<?php
require_once("../configuraciones/conexion.php");
    class UnidadGasto{
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
            $id_unidad = $dato["id_unidad"];
            $nombre_gasto = $dato["nombre_gasto"];
            
            $stmt = $this->conexion_activo->prepare("INSERT INTO unidad_gasto (id_unidad, nombre_gasto) VALUES(?,?)");
            $stmt->bind_param("is", $id_unidad, $nombre_gasto);
            if ($stmt->execute()) {
                return $this->conexion_activo->insert_id;
            } else {
                return 0;
            }
        }
    }
?>