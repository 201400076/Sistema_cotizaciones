<?php
include_once '../modelo/conexionPablo.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Recepción de los datos enviados mediante POST desde el JS   

$cantidad = (isset($_POST['cantidad'])) ? $_POST['cantidad'] : '';
$unidad = (isset($_POST['unidad'])) ? $_POST['unidad'] : '';
$detalle = (isset($_POST['detalle'])) ? $_POST['detalle'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$archivo = (isset($_POST['archivo'])) ? $_POST['archivo'] : '';
$ruta = (isset($_POST['ruta'])) ? $_POST['ruta'] : '';
$id_pendientes = (isset($_POST['id_pendientes'])) ? $_POST['id_pendientes'] : '';
$id_usuario=(isset($_POST['id_usu'])) ? $_POST['id_usu'] : '';
$id_unidad=(isset($_POST['id_unidad'])) ? $_POST['id_unidad'] : '';
$justificacion=(isset($_POST['justificacion'])) ? $_POST['justificacion'] : '';
$fecha=date("Y-m-d");
$carpeta="../archivos/";
switch($opcion){
    case 1: //alta

        $consulta = "INSERT INTO items_pendientes (id_pendientes, cantidad, unidad, detalle, ruta, id_usuarios, archivo,id_gasto) 
        VALUES (NULL, '$cantidad', '$unidad', '$detalle', '$ruta', $id_usuario, '$archivo','$id_unidad')";
        //$consulta = "INSERT INTO personas (nombre, pais, edad) VALUES('$nombre', '$pais', '$edad') ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT id_pendientes,cantidad, unidad, detalle,archivo,ruta FROM items_pendientes ORDER BY id_pendientes DESC LIMIT 1";
        //$consulta = "SELECT id, nombre, pais, edad FROM personas ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
       
        print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
        $conexion = NULL;
        break;      
    case 3://baja
        $consulta = "DELETE FROM items_pendientes WHERE id_pendientes='$id_pendientes' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();   

        $consulta = "SELECT id_pendientes,cantidad, unidad, detalle,archivo,ruta FROM items_pendientes where items_pendientes.id_usuarios='$id_usuario' ORDER BY id_pendientes DESC LIMIT 1";
        //$consulta = "SELECT id, nombre, pais, edad FROM personas ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);          
        print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
        $conexion = NULL;              
        break;      
    case 4://enviar pedido
        $consulta="SELECT u.id_unidad FROM unidad_gasto u, usuarioconrol us WHERE u.id_gasto=us.id_gasto AND us.id_usuarios='$id_usuario'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        $administrativa=$data[0]['id_unidad'];
        
        $consulta= "INSERT INTO pedido(id_pedido,fecha,justificacion,id_usuarios,id_unidad,id_gasto) VALUES (null,'$fecha','$justificacion','$id_usuario','$administrativa','$id_unidad')";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();   
        
        $consulta="SELECT Max(id_pedido) as id_pedido FROM pedido";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        $ultimoPedido=$data[0]['id_pedido'];
        
        $consulta="SELECT id_pendientes,cantidad, unidad, detalle,archivo,ruta,id_gasto FROM items_pendientes WHERE items_pendientes.id_usuarios='$id_usuario'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $items=$resultado->fetchAll(PDO::FETCH_ASSOC);

        foreach($items as $d){
            $id_pedido=$ultimoPedido;
            $cantidad=$d['cantidad'];
            $unidad=$d['unidad'];
            $detalle=$d['detalle'];
            $archivo=$d['archivo'];
            $ruta=$d['ruta'];
            $id_gasto=$d['id_gasto'];
            $consulta="INSERT INTO items(id_pedido,cantidad,unidad,detalle,archivo,ruta,id_gasto) VALUES ('$ultimoPedido','$cantidad','$unidad','$detalle','$archivo','$ruta','$id_gasto')";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
        }

        $consulta = "DELETE FROM items_pendientes WHERE id_usuarios='$id_usuario' and id_gasto='$id_unidad'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        
        $consulta= "INSERT INTO solicitudes(id_solicitudes, id_pedido, estado, fecha_evaluacion, detalle) VALUES (null,$ultimoPedido,'pendiente',null,null)";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();   

        $consulta = "SELECT id_pendientes,cantidad, unidad, detalle,archivo,ruta FROM items_pendientes where items_pendientes.id_usuarios='$id_usuario' ORDER BY id_pendientes DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);        
        print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
        $conexion = NULL;                
        break;     
         
    default:
        $nro=5;
        print json_encode($nro, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
        $conexion = NULL;
    break;
}
?>