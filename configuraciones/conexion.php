<?php
    require('../configuracion.php');
    class Conexion{
        private $conexion;
        
        public function __construct(){
            $this->conexion=new mysqli(DB_HOST,DB_USUARIO,DB_PASSWORD,DB_NOMBRE);
            if($this->conexion->connect_errno){
                //echo "falla de conexion a la base de dato";
                return;
            }
            //echo "conexion exitosa!!!!";
            $this->conexion->set_charset(DB_CHARSET);
        }

        public function getConn(){
            return $this->conexion;
        }
    }

?>