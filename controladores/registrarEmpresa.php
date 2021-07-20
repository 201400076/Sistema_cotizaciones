<?php
$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$correo =(isset($_POST['correo'])) ? $_POST['correo'] : '';
$nit =(isset($_POST['nit'])) ? $_POST['nit'] : '';
$telefono =(isset($_POST['telefono'])) ? $_POST['telefono'] : '';
$direccion =(isset($_POST['direccion'])) ? $_POST['direccion'] : '';
$rubro =(isset($_POST['rubro'])) ? $_POST['rubro'] : '';
$id_solicitud =(isset($_POST['id_solicitud'])) ? $_POST['id_solicitud'] : '';
$usuario =(isset($_POST['usuario'])) ? $_POST['usuario'] : '';

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
$id_empresa=$data[0]['id_empresa'];

$consulta = "UPDATE usuario_cotizador SET id_empresa='$id_empresa' WHERE usuario_cotizador.user_cotizador='$usuario'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

$consulta = "SELECT * FROM usuario_cotizador WHERE usuario_cotizador.user_cotizador='$usuario'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
?>