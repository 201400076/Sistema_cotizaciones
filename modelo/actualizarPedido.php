<?php

include_once '../modelo/conexionPablo.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
$id_solicitud =(isset($_POST['id_solicitud'])) ? $_POST['id_solicitud'] : '';
$id_empresa =(isset($_POST['id_empresa'])) ? $_POST['id_empresa'] : '';
$id_item =(isset($_POST['id_item'])) ? $_POST['id_item'] : '';

    $consulta = "SELECT i.descripcion,i.marca,i.modelo,i.precio_parcial,i.id_items,i.precio_unitario, it.cantidad FROM cotizacion_items i, solicitudes s, items it WHERE it.id_items=i.id_items and i.id_solicitudes=s.id_solicitudes and i.id_items='$id_item'";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        
print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
?>