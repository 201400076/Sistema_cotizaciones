<?php
require_once('../controladores/unidadControlador.php');
//require_once('../controladores/unidadControladorGasto.php');

if (isset($_GET['ruta'])) {
    $metodo = $_GET['ruta'];
    if (isset($_GET['md'])) {
        $modelo = $_GET['md'];
        if ($modelo === 'unidad') {
            $UnidadControlador = new UnidadControlador('.');
            if (method_exists($UnidadControlador, $metodo . 'Controlador')) {
                if (isset($_GET['id'])) {
                    //solo sirve cuando trae el valor id usado por modificar, eliminar y ver un especifico unidad
                    UnidadControlador::{$metodo . 'Controlador'}($_GET['id']);
                } else {
                    //solo para guardar, crear y para listar
                    UnidadControlador::{$metodo . 'Controlador'}();
                }
            }
        } else {
            # esto sirve para trabajar con otros modelos es necesario utilizar ifelse     
        }
    } else {
        $UnidadControlador = new UnidadControlador('.');
        if (method_exists($UnidadControlador, $metodo . 'Controlador')) {
            UnidadControlador::{$metodo . 'Controlador'}();
        }
    }
} else {
    require_once('../vista/home.php');
    //UnidadControlador::{'indexControlador'}();
}
