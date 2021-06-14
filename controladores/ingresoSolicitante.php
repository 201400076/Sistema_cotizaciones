<?php
$usuario = $_POST['usuario'];
$password = $_POST['password'];

include_once '../modelo/conexionPablo.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
$consulta = "SELECT * FROM usuario_cotizador";
//$consulta = "SELECT id, nombre, pais, edad FROM personas ORDER BY id DESC LIMIT 1";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);  

$exite=false;

foreach($data as $d){
    if($usuario==$d['user_cotizador'] && $password==$d['password_cotizador']){
        $exite=true;
        break;
    }
}

if($exite){
    header("location:../vista/registroCotizacion.php?usuario=$usuario");
}else{
    
    header("location:../vista/empresasSolicitantes.php");
}
?>