<?php
    include('../modelo/conexion.php');
    $id=$_GET["id"];
    $conexion->query("DELETE FROM items WHERE id_items='$id'");
    header("Location:solicitudes.php")
?>