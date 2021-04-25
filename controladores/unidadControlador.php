<?php
require_once('../modelo/unidadAdministrativa.php');
require_once('../controladores/validaciones/validacion.php');
require_once('../modelo/facultad.php');
class UnidadControlador extends Unidad {
    private $modelo;
    public function __construct()
    {
        $this->modelo = new Unidad();
    }
    public static function indexControlador(){
        $facultad = new Facultad();
        $facultades = $facultad->getFacultad();
        require_once("../vista/formulariounidadadministrativa.php");
    }

    public static function registerControlador(){
        $unidad = new Unidad();
        $errors = array();
        $dato = [
            "id_facultad" => $_POST['id_facultad'],
            "nombre_unidad" => $_POST['nombre_unidad']
        ];
        if(!validacion::isNull($dato["nombre_unidad"])){
            $alerta = "Debe llenar el campo nombre unidad administrativa";
            echo "<p class='error'>* ".$alerta."</p>";
            $errors[] = $alerta;
        }
        if(!validacion::isNumeric($dato["id_facultad"])){
            $alerta = "Debe llenar el campo de facultad";
            echo "<p class='error'>* ".$alerta."</p>";
            $errors[] = $alerta;
        } 
        if(!Validacion::validarTexto($dato["nombre_unidad"])){
            echo "<p class='error'>* Nombre no Valido contiene espacios en blancos/p>";
            $errors[] = "Nombre no Valido";
        }
        if (count($errors)>0) {
            var_dump($errors);
        } else {
            //echo "no tiene errores";
            $unidad = $unidad->register($dato);
        }
        //$res = new UnidadControlador();
        //$res->unidadControlador();
        
        header("location: ../ruta/ruta.php");
    }
    public static function unidadControlador(){
        $unidad = new Unidad();
        $unidades = $unidad->getUnidadAdministrativa();
        require_once("../vista/formulariounidadgasto.php");
    }
    public static function listarControlador(){
        $unidad = new Unidad();
        $unidades = $unidad->getUnidadAdministrativa();
        require_once("../vista/listarUnidadesAdministrativas.php");
    }
    
}
?>