<?php
    $ids=$_GET["id"];
    include('../modelo/conexion.php');
    $sql= "INSERT INTO `solicitudes`(`id_solicitud`, `id_pedido`, `fecha`, `estado`) VALUES (:idSolicitud,:idPedido,:fecha,:estado)";
    $resultado=$conexion->prepare($sql);
    $resultado->execute(array(":idSolicitud"=>"solicitud-0001",":idPedido"=>$ids, ":fecha"=>"13-13-1995",":estado"=>"pendiente"));        
    header("Location:solicitudes.php");
?>
