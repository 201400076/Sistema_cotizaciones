<?php

    $db_host = "localhost";
    $db_nombre = "sistema_de_cotizaciones";
    $db_usuario = "root";
    $db_contrasenia = "";

    $conexion = mysqli_connect($db_host, $db_nombre, $db_usuario, $db_contrasenia);

    $usuario = $_GET["user"];
    $rol = $_GET["rolUser"];
    $uadmin = $_GET["uadmin"];
    $ugasto = $_GET["ugasto"];

    
    if(mysqli_connect_errno()){
        echo "Fallo al conectar con la Base de Datos";
        exit();
    }

    mysqli_select_db($conexion, $db_nombre) or die ("No se encuentra la Base de Datos");
    mysqli_set_charset($conexion, "utf8");

    $consultaInsert = "INSERT INTO USUARIOCONROL (id_usuario, id_rol, id_gasto) VALUES ($usuario, $rol, $ugasto)";
    $resultado = mysqli_query($conexion, $consultaInsert);
    if($resultado == false){
        echo "Error en la insercion";
    }else{
        echo "Registro guardado";
    }

    mysqli_close($conexion);

?>