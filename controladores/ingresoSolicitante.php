<?php
$usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
$password =(isset($_POST['password'])) ? $_POST['password'] : '';

include_once '../modelo/conexionPablo.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
$fila=null;
$exite=false;

    $consulta = "SELECT * FROM usuarioconrol r, usuarios u WHERE r.id_usuarios=u.id_usuarios";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);  

    foreach($data as $d){
            //if($usuario==$d['usuario'] && password_verify($password,$d['password'])){
        if($usuario==$d['usuario'] && $password==$d['password']){
            $exite=true;
            $fila=$d;
            if($d['id_unidad']!=null){
                $unidad=$d['id_unidad'];
                $consulta = "SELECT nombres,apellidos,rolAsignado,nombre_unidad FROM unidad_administrativa a, usuarios u, usuarioconrol r WHERE r.id_unidad=a.id_unidad AND r.id_usuarios=u.id_usuarios and a.id_unidad='$unidad'";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();
                $data1=$resultado->fetchAll(PDO::FETCH_ASSOC);  
                $fila=$data1[0];
                session_start();
                $_SESSION["usuario"]=$d['id_usuarios'];
                $_SESSION["unidad"]=$d['id_unidad'];
                $fullName=$d['nombres']." ".$d['apellidos'];
                $_SESSION["nombre_usuario"]=$fullName;                
                break;
            }elseif($d['id_gasto']!=null){
                $unidad=$d['id_gasto'];
                $consulta = "SELECT nombres,apellidos,rolAsignado,nombre_gasto,a.id_gasto FROM unidad_gasto a, usuarios u, usuarioconrol r WHERE r.id_gasto=a.id_gasto AND r.id_usuarios=u.id_usuarios and a.id_gasto='$unidad'";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();
                $data1=$resultado->fetchAll(PDO::FETCH_ASSOC);  
                $fila=$data1[0];
                session_start();
                $_SESSION["usuario"]=$d['id_usuarios'];
                $_SESSION["unidad"]=$d['id_gasto'];
                $fullName=$d['nombres']." ".$d['apellidos'];
                $_SESSION["nombre_usuario"]=$fullName;
                break;
            }
        }
    }
    if(!$exite){        
        $consulta = "SELECT * FROM usuario_cotizador";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);  
        foreach($data as $d){
            if($usuario==$d['user_cotizador'] && $password==$d['password_cotizador']){
                $consulta = "SELECT nombre_empresa,rolAsignado,u.estado_cotizador, e.id_empresa,u.id_solicitudes,u.user_cotizador FROM usuario_cotizador u, empresas e WHERE e.id_empresa=u.id_empresa and u.user_cotizador='$usuario'";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();
                $data1=$resultado->fetchAll(PDO::FETCH_ASSOC);  
                //var_dump($data1);
                $exite=true;
                $fila=$data1[0];                      
                    break;
            }
        }
    }

print json_encode($fila, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
?>