<?php
    require_once('../controladores/unidadControlador.php');
    if (isset($_GET['ruta'])) {
        $metodo = $_GET['ruta'];
        $UnidadControlador = new UnidadControlador('.');
        if (method_exists($UnidadControlador, $metodo.'Controlador')) {
            UnidadControlador::{$metodo.'Controlador'}();
        }
    } else {
        echo "esta no es la ruta";
    }

?>