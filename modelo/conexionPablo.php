<?php
    require('configuracion.php');
    try{
        $conexion=new PDO('mysql:=host=localhost; dbname=sistema_de_cotizaciones','root','');
        $conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $conexion->exec("SET CHARACTER SET UTF8");
    }
    catch(Exception $e){
        die("error") . $e->getMEssage();
        echo "error!!" . $e->getLine();
    }
?>