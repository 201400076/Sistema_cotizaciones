<?php
    $db_host = "localhost";
    $db_nombre = "sistema_de_cotizaciones";
    $db_usuario = "root";
    $db_contra = "";
    
    $conexion = mysqli_connect($db_host, $db_usuario, $db_contra, $db_nombre);


    $id_usuario = $_GET['user'];
    $id_r = $_GET['tipoUser'];


    $consulta = "INSERT INTO usuarioconrol(id_usuarios, id_rol) VALUES('$id_usuario', '$id_r')";
    $res = mysqli_query($conexion, $consulta);

    if($res == false){
        echo "Error al Registrar";
        }else{
        echo "Registro Guardado";
    }

?>