<?php
$usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
$password =(isset($_POST['password'])) ? $_POST['password'] : '';

include_once '../modelo/conexionPablo.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
$fila=null;
$exite=false;

$consulta = "SELECT * FROM usuario_cotizador u WHERE u.user_cotizador='$usuario' AND u.password_cotizador='$password'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);  

foreach($data as $d){
    //if($usuario==$d['usuario'] && password_verify($password,$d['password'])){
    if($usuario==$d['user_cotizador'] && $password==$d['password_cotizador']){
    $exite=true;
    $fila=$d;                      
        break;
    }
}

print json_encode($fila, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
?>