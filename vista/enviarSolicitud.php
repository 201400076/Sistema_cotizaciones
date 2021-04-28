<?php
    $ids=$_GET["id"];
    echo $ids;
    include('../modelo/conexionPablo.php');
    $sql= "INSERT INTO `solicitudes`(`id_pedido`, `estado`) VALUES (:idPedido,:estado)";
    $resultado=$conexion->prepare($sql);
    $resultado->execute(array(":idPedido"=>1,":estado"=>"pendiente"));        
    
?>
