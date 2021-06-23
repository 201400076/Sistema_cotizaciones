<?php
$id_usu = (isset($_POST['id_usu'])) ? $_POST['id_usu'] : '';

include_once '../modelo/conexionPablo.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
$consulta = "SELECT * FROM items_pendientes WHERE id_usuarios='$id_usu'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);  

$fila = empty($data);

print json_encode($fila, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
?>