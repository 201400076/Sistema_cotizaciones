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
<<<<<<< HEAD

=======
>>>>>>> 7af3d9df64eeef8eeb31cbb131604d9d55fe7036
    function usuarioExiste($usuario){
        global $estadoconexion;

        $stmt = $estadoconexion->prepare("SELECT id_unidad FROM unidad_administrativa WHERE nombre_usuario = ? LIMIT 1");
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $stmt->store_result();
        $num = $stmt->num_rows;
        $stmt->close();
        
        if($num > 0){
            return true;
        }else{
            return false;
        }
    }
<<<<<<< HEAD

=======
>>>>>>> 7af3d9df64eeef8eeb31cbb131604d9d55fe7036
}
?>
