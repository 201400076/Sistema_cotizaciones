<?php

include_once '../modelo/conexionPablo.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
$rutaManual =(isset($_POST['rutaManual'])) ? $_POST['rutaManual'] : '';
$nombre_usu =(isset($_POST['nombre_usu'])) ? $_POST['nombre_usu'] : '';

    $consulta = "UPDATE usuario_cotizador SET cotizacion_manual='$rutaManual' WHERE usuario_cotizador.user_cotizador='$nombre_usu'";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
    
    $consulta = "SELECT * FROM usuario_cotizador WHERE usuario_cotizador.user_cotizador='$nombre_usu'";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

    
        
print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
?>