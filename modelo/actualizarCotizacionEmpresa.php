<?php

include_once '../modelo/conexionPablo.php';
$id_solicitud = (isset($_POST['id_solicitud'])) ? $_POST['id_solicitud'] : '';
$nombre_usu = (isset($_POST['nombre_usu'])) ? $_POST['nombre_usu'] : '';
$data=null;

        $objeto = new Conexion();
        $conexion = $objeto->Conectar();

        $consulta = "DELETE FROM usuario_cotizador WHERE user_cotizador='$nombre_usu' and id_solicitudes='$id_solicitud'";        	
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        
        $consulta = "UPDATE solicitudes_cotizaciones SET cantidad_cotizaciones = cantidad_cotizaciones + 1 WHERE id_solicitudes='$id_solicitud'";        	        
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        
        $data='exito';        
print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
?>