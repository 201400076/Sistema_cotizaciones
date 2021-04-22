<?php
require_once('../modelo/unidadAdministrativa.php');
class UnidadControlador extends Unidad {
    private $modelo;
    public function __construct()
    {
        $this->modelo = new Unidad();
    }
    public static function registerControlador(){
        $unidad = new Unidad();
        $dato = [
            "nombre" => $_POST['unidad_administrativa'],
            "facultad" => $_POST['facultad'],
            "monto_tope" => $_POST['monto_tope']
        ];
        $unidad = $unidad->register("unidad", $dato);
        header("location:http://proyecto/Sistema_cotizaciones/vista/formulariounidadadministrativa.php");
    }
}
?>