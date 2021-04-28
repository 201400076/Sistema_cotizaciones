<?php
require_once("../configuraciones/conexion.php");
    class Validacion{

    private $conexion;
    private $conexion_activo;
    public function __construct()
    {
        
    }
    //validaciones
    public static function isNull($nombre)
    {
        //var_dump(strlen(trim($nombre)));
        if (strlen(trim($nombre)) > 0){
            return true;
        } else {
            return false;
        }
    }
    public static function isNumeric($value )
    {
        if (is_numeric($value)){
            return true;
        } else {
            return false;
        }
    } 
    public static function validarTexto($texto) {
        $trimmed = trim($texto, " \t\n\r");
        if ($texto == $trimmed) {
            return true;
        }else {
            return false;
        }
    }
}
?>