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





    /*public static function isExiste($nombre){
        $conexion = new Conexion();
        $conexion_activo = $conexion->getConn();

        $stmt = $conexion_activo->prepare("SELECT id FROM unidad_gasto WHERE nombre_gasto = ? LIMIT 1");
        $stmt->bind_param("s", $nombre);
        $stmt->execute();
        $stmt->store_result();
        $num = $stmt->num_rows;

        if ($num > 0) {
            return true;
        } else {
            return false;
        }
                   
    }*/
}
?>