<?php
    class Items{
        private $cantidad;
        private $unidad;
        private $detalle;
        private $archivo;
        private $ruta;

        public function __construct($cant,$unid,$det,$arc,$rut){
            $this->cantidad=$cant;
            $this->unidad=$unid;
        }

        public function getCantidad(){
            return $this->cantidad;
        }
        public function getUnidad(){
            return $this->unidad;
        }
    }
?>