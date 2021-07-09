<?php
    $id_solicitud=$_POST['id_solicitud'];
    $codigo=$_POST['codigo'];

    include_once '../modelo/conexionPablo.php';

    $objeto = new Conexion();
    $conexion = $objeto->Conectar();
    $consulta="SELECT * FROM usuario_cotizador u WHERE user_cotizador='$codigo' and id_solicitudes='$id_solicitud'";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
    
    print json_encode($data, JSON_UNESCAPED_UNICODE);
?>