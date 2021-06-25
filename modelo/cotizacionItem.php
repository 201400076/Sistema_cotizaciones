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

    $consulta = "INSERT INTO cotizacion_items (id_item_cotizacion, marca, modelo, descripcion, precio_unitario, precio_parcial, id_items,id_empresa,id_solicitudes) 
        VALUES (NULL, '$marca', '$modelo', '$descripcion', '$unit', '$total', '$id_item','$id_empresa','$id_solicitud')";
        //$consulta = "INSERT INTO personas (nombre, pais, edad) VALUES('$nombre', '$pais', '$edad') ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT*FROM cotizacion_items ORDER BY id_item_cotizacion DESC LIMIT 1";
        //$consulta = "SELECT id, nombre, pais, edad FROM personas ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        
print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
?>