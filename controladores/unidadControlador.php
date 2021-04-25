<?php
require_once('../modelo/unidadAdministrativa.php');
require_once('../controladores/validaciones/validacion.php');
require_once('../modelo/facultad.php');
require_once('../modelo/unidadGasto.php');
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
    public static function editarControlador($id){
        $unidad = new Unidad();
        $facultad = new Facultad();
        $unidad = $unidad->editarUnidad($id);
        if (count($unidad) > 0) {
            $facultades = $facultad->getFacultad();
            require_once("../vista/editarUnidadAdministrativa.php");
        } else {
            UnidadControlador::listarControlador();
        }
    }
    public static function actualizarControlador(){
        $unidad = new Unidad();
        $facultad = new Facultad();
        $status = 0;
        $id = $_GET['id'];
        $errors = array();

        $dato = [
            "id_facultad" => $_POST['id_facultad'],
            "nombre_unidad" => $_POST['nombre_unidad'],
            "monto_tope" => $_POST['monto_tope'],
            "id_unidad" => $_GET['id']
        ];

        if(!validacion::isNull($dato["nombre_unidad"])){
           
            $alerta = "Debe llenar el campo nombre unidad administrativa";
            //echo "<p class='error'>* ".$alerta."</p>";
            $errors[] = $alerta;
        }
        if(!validacion::isNumeric($dato["id_facultad"])){
            $alerta = "Debe llenar el campo de facultad";
            //echo "<p class='error'>* ".$alerta."</p>";
            $errors[] = $alerta;
        } 
        if(!validacion::isNumeric($dato["monto_tope"])){
            $alerta = "Debe llenar el campo monto tope";
            //echo "<p class='error'>* ".$alerta."</p>";
            $errors[] = $alerta;
        }
        if(!Validacion::validarTexto($dato["nombre_unidad"])){
            //echo "<p class='error'>* Nombre no Valido contiene espacios en blancos/p>";
            $errors[] = "Nombre no Valido";
        }
        if (count($errors)>0) {
            $unidad = new Unidad();
            $facultad = new Facultad();
            $unidad = $unidad->editarUnidad($id);
            if (count($unidad) > 0) {
                $facultades = $facultad->getFacultad();
                require_once("../vista/editarUnidadAdministrativa.php");
            } else {
                UnidadControlador::listarControlador();
            }
        } else {
            $status = $unidad->actualizarUnidad($dato);
            if ($status == 0) {
                $facultades = $facultad->getFacultad();
                require_once("../vista/editarUnidadAdministrativa.php");
            } else {
                UnidadControlador::listarControlador();
            }
        }

    }



    public static function eliminarControlador($id){
        $unidad = new Unidad();
        $unidadGasto = new UnidadGasto();
        $estado = -1;
        $unidadGasto->eliminarUnidadGastoPorUnidadAdmin($id);
        $estadoactual = $unidad->eliminarUnidad($id);
       if ($estadoactual) {
           $estado = 1;
       } elseif ($estado < 2) {
           $estado = 0;
       }
       
        $unidades = $unidad->getUnidadAdministrativa();
        require_once("../vista/listarUnidadesAdministrativas.php");
    }
    
}
?>