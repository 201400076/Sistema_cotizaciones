<?php

include_once '../modelo/conexionPablo.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
$id_empresa =(isset($_POST['id_empresa'])) ? $_POST['id_empresa'] : '';
$rutaManual =(isset($_POST['rutaManual'])) ? $_POST['rutaManual'] : '';
$nombre_usu =(isset($_POST['nombre_usu'])) ? $_POST['nombre_usu'] : '';

    $consulta = "UPDATE usuario_cotizador SET cotizacion_manual=[value-8] WHERE 1";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        
print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
?>