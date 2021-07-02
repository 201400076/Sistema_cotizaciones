<?php
    include_once '../modelo/conexionPablo.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();
    $id_administrador=  $_SESSION["administrador"];
    $consulta="SELECT * FROM usuarios s,usuarioconrol c, unidad_administrativa u WHERE c.id_usuarios=s.id_usuarios and u.id_unidad=c.id_unidad  and s.id_usuarios='$id_administrador'";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $administracion=$resultado->fetchAll(PDO::FETCH_ASSOC);

    $consulta="SELECT nombres,apellidos FROM usuarios WHERE usuarios.id_usuarios='$id_administrador'";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data2=$resultado->fetchAll(PDO::FETCH_ASSOC);
    $nombre=$data2['0']['apellidos']." ".$data2['0']['nombres'];       

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.83.1">
    <title>Headers · Bootstrap v5.0</title>
    <!-- Bootstrap core CSS -->
    <link href="../librerias/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="../vista/css/headers.css" rel="stylesheet">
    <script src="../librerias/bootstrap/jjs/bootstrap.bundle.min.js"></script>    
    <script src="../librerias/jquery/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../vista/css/estiloFRU.css" media="screen" />      
  </head>
<body>

<div class="container-fluid">
    <div class="row nav">
        <div class=" col-10">          
            <h1>Sistema de cotizacion</h1>                         
        </div>  
    </div>                               
</div>
