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
        if (UnidadControlador::existeUnidadGastoControlador($dato["nombre_gasto"])) {
            $alerta = "unidad de gasto ya existe";
            //echo "<p class='error'>* ".$alerta."</p>";
            $errors[] = $alerta;
        }
        if (count($errors)>0) {
            var_dump($errors);
        } else {
            #echo "no tiene errores";
            $unidad = $unidad->register($dato);
        }
        //header("location: ../ruta/rutaGasto.php?ruta=unidad");
        //header("location: ../ruta/rutaGasto.php");
        header("location: ../ruta/ruta.php");
    }
    public static function existeUnidadGastoControlador($nombre){
        $unidad = new UnidadGasto();
        $existe = false;
        $existe = $unidad->existeUnidadGasto($nombre);
        
        if ($existe) {
            return $existe;
        } 
    }
    
    
    public static function eliminarUnidadGastoControlador($id){
        $unidad = new UnidadGasto();
        $estado = -1;
        $estadoactual = $unidad->eliminarUnidadGasto($id);
       if ($estadoactual) {
           $estado = 1;
       } elseif ($estado < 2) {
           $estado = 0;
       }
       
        $unidadesGasto = $unidad->getUnidadGasto();
        require_once("../vista/listarUnidadesGasto.php");
    }
    public static function actualizarUnidadGastoControlador(){
        $unidad = new Unidad();
        $unidadGasto = new UnidadGasto();
        $status = 0;
        $id = $_GET['id'];
        $errors = array();

        $dato = [
            "id_unidad" => $_POST['id_unidad'],
            "nombre_gasto" => $_POST['nombre_gasto'],
            "id_gasto" => $_GET['id']
        ];

        if(!validacion::isNull($dato["nombre_gasto"])){
           
            $alerta = "Debe llenar el campo nombre unidad gasto";
            //echo "<p class='error'>* ".$alerta."</p>";
            $errors[] = $alerta;
        }
        if(!validacion::isNumeric($dato["id_unidad"])){
            $alerta = "Debe llenar el campo de unidad de gasto";
            //echo "<p class='error'>* ".$alerta."</p>";
            $errors[] = $alerta;
        } 
        
        if(!Validacion::validarTexto($dato["nombre_gasto"])){
            //echo "<p class='error'>* Nombre no Valido contiene espacios en blancos/p>";
            $errors[] = "Nombre no Valido";
        }
        
        
            if (count($errors)>0) {
                $unidad = new Unidad();
                $unidadGasto = new UnidadGasto();
                $unidadGasto = $unidadGasto->editarUnidadGasto($id);
                if (count($unidadGasto) > 0) {
                    $unidades = $unidad->getUnidadAdministrativa();
                    require_once("../vista/editarUnidadGasto.php");
                } else {
                    UnidadControlador::listarControlador();
                }
            } else {
                $status = $unidadGasto->actualizarUnidadGasto($dato);
                if ($status == 0) {
                    $unidades = $unidad->getUnidadAdministrativa();
                    require_once("../vista/editarUnidadGasto.php");
                } else {
                    UnidadControlador::listarControlador();
                }
            }

    }
    
    
    
}
?>