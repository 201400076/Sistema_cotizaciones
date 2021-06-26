<?php
require_once("../configuraciones/conexion.php");
    class Unidad{
        private $modelo;
        private $conexion;
        private $conexion_activo;
        
        public function __construct()
        {
            $this->modelo = array();
            $this->conexion = new Conexiones();
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
         
        public function editarUnidad($id){
            $stmt = $this->conexion_activo->prepare("SELECT * FROM unidad_administrativa WHERE id_unidad=?");
            $stmt->bind_param("s", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $this->modelo = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            return $this->modelo;
        }  
        public function actualizarUnidad($dato){
            $id_facultad = $dato["id_facultad"];
            $nombre_unidad = $dato["nombre_unidad"];
            $id_unidad = $dato["id_unidad"];
            $monto_tope = $dato["monto_tope"];
            $stmt = $this->conexion_activo->prepare("UPDATE unidad_administrativa SET nombre_unidad=?, id_facultad=?, monto_tope=? WHERE id_unidad=".$id_unidad);
            $stmt->bind_param("sii", $nombre_unidad, $id_facultad, $monto_tope);
            if ($stmt->execute()) {
                return 1;
            } else {
                return 0;
            }
        }
        public function eliminarUnidad($id){
            $stmt = $this->conexion_activo->prepare("DELETE FROM unidad_administrativa WHERE id_unidad=?");
            $stmt->bind_param("s", $id);
            if ($stmt->execute()) {
                $stmt->close();
                return true;
            } else {
                $stmt->close();
                return false;
            }
        }
        public function existeUnidad($nombre){
            $stmt = $this->conexion_activo->prepare("SELECT nombre_unidad FROM unidad_administrativa WHERE nombre_unidad = ?  LIMIT 1");
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
    }
?>
