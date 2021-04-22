<?php
    class Unidad{
        private $modelo;
        private $database;
        public function __construct()
        {
            $this->modelo = array();
            $this->database = new PDO('mysql:host=localhost;dbname=proyecto', 'root', '');
        }
        public function register($tabla, $dato){
            var_dump($dato);
            $nombre = $dato["nombre"];
            $facultad = $dato["facultad"];
            $monto_tope = $dato["monto_tope"];
            
            $consulta = 'insert into '.$tabla.' (id, nombre_unidad, facultad, monto_tope) values(null, "'.$nombre.'", "'.$facultad.'", "'.$monto_tope.'")';
            $resultado = $this->database->query($consulta);
            if ($resultado){
                return true;
            } else {
                return false;
            }
            
        }
    }
?>
