<?php
require_once('../modelo/unidadGasto.php');
require_once('../controladores/validaciones/validacion.php');
require_once('../modelo/unidadAdministrativa.php');
class UnidadControlador extends UnidadGasto {
    private $modelo;
    public function __construct()
    {
        $this->modelo = new UnidadGasto();
    }

    public static function registerControlador(){
        $unidad = new UnidadGasto();
        $errors = array();
        $dato = [
            "id_unidad" => $_POST['id_unidad'],
            "nombre_gasto" => $_POST['nombre_gasto']
        ];
        if(!validacion::isNull($dato["nombre_gasto"])){
            $alerta = "Debe llenar el campo nombre unidad de gasto";
            echo "<p class='error'>* ".$alerta."</p>";
            $errors[] = $alerta;
        }
        if(!validacion::isNumeric($dato["id_unidad"])){
            $alerta = "Debe llenar el campo id de unidad administrativa";
            echo "<p class='error'>* ".$alerta."</p>";
            $errors[] = $alerta;
        }
        if(!Validacion::validarTexto($dato["nombre_gasto"])){
            echo "<p class='error'>* Nombre no Valido contiene espacios en blanco</p>";
            $errors[] = "Nombre no Valido";
        }
        if (count($errors)>0) {
            var_dump($errors);
        } else {
            #echo "no tiene errores";
            $unidad = $unidad->register($dato);
        }
        
        
        //header("location: ../ruta/rutaGasto.php");
        header("location: ../ruta/rutaGasto.php?ruta=unidad");
    }
    
    
    
}
?>