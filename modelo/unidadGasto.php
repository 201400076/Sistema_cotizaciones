<?php
    class UnidadGasto{
        private $modelo;
        private $database;
        public function __construct()
        {
            $this->modelo = array();
            $this->database = new PDO('mysql:host=localhost;dbname=proyecto', 'root', '');
        }
        public function register($tabla, $dato){
            //var_dump($dato);
            $nombre = $dato["nombre"];
            $unidad_administrativa = $dato["unidad_administrativa"];
            $consulta = 'insert into '.$tabla.'(id, nombre_unidad_gasto, nombre_unidad_administrativa) values(null, "'.$nombre.'", "'.$unidad_administrativa.'")';
            $resultado = $this->database->query($consulta);
            if ($resultado){
                return true;
            } else {
                return false;
            }
            
        }
    }
?>