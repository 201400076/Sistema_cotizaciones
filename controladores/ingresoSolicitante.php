<?php
$usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
$password =(isset($_POST['password'])) ? $_POST['password'] : '';

include_once '../modelo/conexionPablo.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
$consulta = "SELECT * FROM usuarioconrol r, usuarios u WHERE r.id_usuarios=u.id_usuarios";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);  
$fila=null;
$exite=false;

foreach($data as $d){
    //if($usuario==$d['usuario'] && password_verify($password,$d['password'])){
    if($usuario==$d['usuario'] && $password==$d['password']){
    $exite=true;
        $fila=$d;   
        session_start();
        if($d['id_gasto']!=null){
            $_SESSION["usuario"]=$d['id_usuarios'];
        }elseif($d['id_unidad']!=null){
            $_SESSION["administrador"]=$d['id_usuarios'];
        }
        break;
    }
}

print json_encode($fila, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
?>