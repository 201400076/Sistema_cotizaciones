<?php

include_once '../modelo/conexionPablo.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
$marca = (isset($_POST['marca'])) ? $_POST['marca'] : '';
$modelo =(isset($_POST['modelo'])) ? $_POST['modelo'] : '';
$descripcion =  (isset($_POST['descripcion'])) ? $_POST['descripcion'] : '';
$unit = (isset($_POST['unit'])) ? $_POST['unit'] : '';
$total =(isset($_POST['total'])) ? $_POST['total'] : '';
$id_solicitud =(isset($_POST['id_solicitud'])) ? $_POST['id_solicitud'] : '';
$id_empresa =(isset($_POST['id_empresa'])) ? $_POST['id_empresa'] : '';
$id_item =(isset($_POST['id_item'])) ? $_POST['id_item'] : '';
$ruta =(isset($_POST['ruta'])) ? $_POST['ruta'] : '';
$nombre_usu=(isset($_POST['nombre_usu'])) ? $_POST['nombre_usu'] : '';

    $consulta = "SELECT i.descripcion,i.marca,i.modelo,i.precio_parcial,i.id_items,i.precio_unitario, it.cantidad FROM cotizacion_items i, solicitudes s, items it WHERE it.id_items=i.id_items and i.id_solicitudes=s.id_solicitudes and i.id_items='$id_item' and i.user_cotizador='$nombre_usu'";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $items=$resultado->fetchAll(PDO::FETCH_ASSOC);
    if(empty($items)){
        $consulta = "INSERT INTO cotizacion_items (id_item_cotizacion, marca, modelo, descripcion, precio_unitario, precio_parcial, id_items,id_empresa,id_solicitudes,user_cotizador,ruta) 
        VALUES (NULL, '$marca', '$modelo', '$descripcion', '$unit', '$total', '$id_item','$id_empresa','$id_solicitud','$nombre_usu','$ruta')";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        $consulta = "SELECT*FROM cotizacion_items ORDER BY id_item_cotizacion DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);    
    }else{
        $consulta = "UPDATE cotizacion_items SET 
        marca='$marca',
        modelo='$modelo',
        descripcion='$descripcion',
        precio_unitario='$unit',
        precio_parcial='$total'
        WHERE cotizacion_items.id_items='$id_item'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        $consulta = "SELECT*FROM cotizacion_items ORDER BY id_item_cotizacion DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);    
    }  
        
print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
?>