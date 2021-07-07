<?php
    $db_host = "localhost";
    $db_nombre = "sistema_de_cotizaciones";
    $db_usuario = "root";
    $db_contrasenia = "";

    $conexion = mysqli_connect($db_host, $db_nombre, $db_usuario, $db_contrasenia);

    if (!$conexion) {
        die("Conecxion fallida: " . mysqli_connect_error());
    }
    echo "Conexion exitosa";
    mysqli_close($conexion);

?>