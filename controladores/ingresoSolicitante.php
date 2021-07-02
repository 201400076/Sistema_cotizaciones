<?php
$usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
$password =(isset($_POST['password'])) ? $_POST['password'] : '';
$rol =(isset($_POST['rol'])) ? $_POST['rol'] : '';

include_once '../modelo/conexionPablo.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
$fila=null;
$exite=false;

switch ($rol) {
    case 'administrativa':
        $consulta = "SELECT * FROM usuarioconrol r, usuarios u WHERE r.id_usuarios=u.id_usuarios and r.rolAsignado='Unidad Administrativa'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);  

        foreach($data as $d){
            //if($usuario==$d['usuario'] && password_verify($password,$d['password'])){
            if($usuario==$d['usuario'] && $password==$d['password']){
            $exite=true;
                $fila=$d;
                session_start();
                $_SESSION["administrador"]=$d['id_usuarios'];
                $_SESSION["unidadAdmin"]=$d['id_unidad'];
                $fullName=$d['nombres']." ".$d['apellidos'];
                $_SESSION["nombreUA"]=$fullName;                
                break;
            }
        }
        
        
        break;
        case 'empresa':
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
            break;
        case 'gasto':
                $consulta = "SELECT * FROM usuarioconrol r, usuarios u WHERE r.id_usuarios=u.id_usuarios and r.rolAsignado='Unidad de Gasto'";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();
                $data=$resultado->fetchAll(PDO::FETCH_ASSOC);  
        
                foreach($data as $d){
                    //if($usuario==$d['usuario'] && password_verify($password,$d['password'])){
                    if($usuario==$d['usuario'] && $password==$d['password']){
                    $exite=true;
                    $fila=$d; 
                        session_start();
                        $_SESSION["usuario"]=$d['id_usuarios'];
                        $_SESSION["unidadGasto"]=$d['id_gasto'];
                        $fullName=$d['nombres']." ".$d['apellidos'];
                        $_SESSION["nombreUG"]=$fullName;                
                        break;
                    }
                }
        break;
        case 'administrador':
            # code...
            break;    
}

print json_encode($fila, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
?>