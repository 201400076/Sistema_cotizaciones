<?php
    class Validacion{

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
}
?>