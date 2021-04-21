<?php
require_once('../modelo/unidadGasto.php');
class UnidadGastoControlador extends Unidad {
    private $modelo;
    public function __construct()
    {
        $this->modelo = new Unidad();
    }
    public static function registerControlador(){
        $unidad_gasto = new Unidad();
        $dato = [
            "nombre" => $_POST['nombre_unidad_gasto'],
            "unidad_administrativa" => $_POST['nombre_unidad_administrativa']
        ];
        $unidad_gasto = $unidad_gasto->register("unidadGasto", $dato);
        header("location:http://proyecto/formulariounidadgasto.php");
    }
}
?>