<?php

include_once '../modelo/conexionPablo.php';
$id_solicitud = (isset($_POST['id_solicitud'])) ? $_POST['id_solicitud'] : '';
$nombre_usu = (isset($_POST['nombre_usu'])) ? $_POST['nombre_usu'] : '';

        $objeto = new Conexion();
        $conexion = $objeto->Conectar();
        $consulta = "UPDATE usuario_cotizador SET estado_cotizador= true WHERE id_solicitudes='$id_solicitud' && user_cotizador='$nombre_usu'";        	
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $data='exito';        
print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
?>