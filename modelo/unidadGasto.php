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
        public function getUnidadGasto(){
            $stmt = $this->conexion_activo->prepare("SELECT * FROM unidad_gasto");
            $stmt->execute();
            $result = $stmt->get_result();
            $this->modelo = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            return $this->modelo;
        }
        public function eliminarUnidadGastoPorUnidadAdmin($id){
            $stmt = $this->conexion_activo->prepare("DELETE FROM unidad_gasto WHERE id_unidad=?");
            $stmt->bind_param("s", $id);
            if ($stmt->execute()) {
                $stmt->close();
                return true;
            } else {
                $stmt->close();
                return false;
            }
        }
        public function existeUnidadGasto($nombre){
            $stmt = $this->conexion_activo->prepare("SELECT nombre_gasto FROM unidad_gasto WHERE nombre_gasto = ?  LIMIT 1");
            $stmt->bind_param("s", $nombre);
            $stmt->execute();
            $stmt->store_result();
            $num = $stmt->num_rows;
            $stmt->close();
            var_dump($num);
            if($num > 0){
                return true;
            }else{
                return false;
            }
        }
        public function editarUnidadGasto($id){
            $stmt = $this->conexion_activo->prepare("SELECT * FROM unidad_gasto WHERE id_gasto=?");
            $stmt->bind_param("s", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $this->modelo = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            return $this->modelo;
        }  
        public function actualizarUnidadGasto($dato){
            $id_gasto = $dato["id_gasto"];
            $nombre_gasto = $dato["nombre_gasto"];
            $id_unidad = $dato["id_unidad"];
            $stmt = $this->conexion_activo->prepare("UPDATE unidad_gasto SET nombre_gasto=?, id_unidad=? WHERE id_gasto=".$id_gasto);
            $stmt->bind_param("si", $nombre_gasto, $id_unidad);
            if ($stmt->execute()) {
                return 1;
            } else {
                return 0;
            }
        }
        public function eliminarUnidadGasto($id){
            $stmt = $this->conexion_activo->prepare("DELETE FROM unidad_gasto WHERE id_gasto=?");
            $stmt->bind_param("s", $id);
            if ($stmt->execute()) {
                $stmt->close();
                return true;
            } else {
                $stmt->close();
                return false;
            }
        }

        
    }
?>