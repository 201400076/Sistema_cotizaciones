<?php
$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$correo =(isset($_POST['correo'])) ? $_POST['correo'] : '';
$nit =(isset($_POST['nit'])) ? $_POST['nit'] : '';
$telefono =(isset($_POST['telefono'])) ? $_POST['telefono'] : '';
$direccion =(isset($_POST['direccion'])) ? $_POST['direccion'] : '';
$rubro =(isset($_POST['rubro'])) ? $_POST['rubro'] : '';
$id_solicitud =(isset($_POST['id_solicitud'])) ? $_POST['id_solicitud'] : '';

include_once '../modelo/conexionPablo.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
$fila=null;
$exite=false;

$consulta = "INSERT INTO empresas (nombre_empresa,correo_empresa,rubro,nit,telefono,direccion) 
VALUES ('$nombre', '$correo', '$rubro', '$nit', $telefono, '$direccion')";
$resultado = $conexion->prepare($consulta);
$resultado->execute(); 

$consulta = "SELECT * FROM empresas ORDER BY id_empresa DESC LIMIT 1";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

$user = generarUsername();

while(usuarioExiste($user,$conexion)){
    $user = generarUsername();
}

$pass = generarPassword();
$id_empresa=$data[0]['id_empresa'];
$rol='Empresa';
$estado=0;

$consulta = "INSERT INTO usuario_cotizador (user_cotizador,password_cotizador,id_empresa,estado_cotizador,id_solicitudes,rolAsignado) 
VALUES ('$user', '$pass', '$id_empresa', '$estado', $id_solicitud, '$rol')";
$resultado = $conexion->prepare($consulta);
$resultado->execute(); 

$consulta = "SELECT * FROM usuario_cotizador ORDER BY id_usuario_cotizador DESC LIMIT 1";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;

function usuarioExiste($usuario,$conexion){
    $consulta = "SELECT user_cotizador FROM usuario_cotizador WHERE user_cotizador='$usuario'";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
     
        
    if(count($data) > 0){
        return true;
    }else{
        return false;
    }
}

function generarPassword(){
    $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
    $password = "";
    for($i=0;$i<16;$i++) {
        $password .= substr($str,rand(0,62),1);
    }
    return $password;
}

function generarUsername(){
    $nombres = ["empresa", "compania", "negocio", "sociedad", "comercio", "establecimiento", "firma", "cotizador", "usuario"];
    $letras = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J","K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"];
    $nombre = $nombres[ mt_rand(0, count($nombres) -1) ];
    $letra1 = $letras[ mt_rand(0, count($letras) -1) ];
    $letra2 = $letras[ mt_rand(0, count($letras) -1) ];
    $numero1 = mt_rand(0,10);
    $numero2 = mt_rand(0,10);
    return "$nombre$letra1$numero1$letra2$numero2";
}
?>