<?php
$usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
$password =(isset($_POST['password'])) ? $_POST['password'] : '';

include_once '../modelo/conexionPablo.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
$consulta = "SELECT * FROM usuario_cotizador";
//$consulta = "SELECT id, nombre, pais, edad FROM personas ORDER BY id DESC LIMIT 1";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);  
$fila=null;
$exite=false;

foreach($data as $d){
    if($usuario==$d['user_cotizador'] && password_verify($password,$d['password_cotizador'])){
        $exite=true;
        $fila=$d;        
        break;
    }
}

print json_encode($fila, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
?>