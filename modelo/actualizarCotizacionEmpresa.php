<?php

include_once '../modelo/conexionPablo.php';
$id_solicitud = (isset($_POST['id_solicitud'])) ? $_POST['id_solicitud'] : '';
$nombre_usu = (isset($_POST['nombre_usu'])) ? $_POST['nombre_usu'] : '';
$data=null;

        $objeto = new Conexion();
        $conexion = $objeto->Conectar();

        $consulta="SELECT i.id_items,i.cantidad, i.unidad,i.detalle,i.archivo,i.ruta FROM solicitudes s, pedido p, items i WHERE (s.id_pedido=p.id_pedido and p.id_pedido=i.id_pedido) and s.id_solicitudes='$id_solicitud'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data2=$resultado->fetchAll(PDO::FETCH_ASSOC);

        $consulta="SELECT i.descripcion,i.marca,i.modelo,i.precio_parcial,i.id_items,i.precio_unitario FROM cotizacion_items i WHERE i.id_solicitudes='$id_solicitud' and i.user_cotizador='$nombre_usu'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data1=$resultado->fetchAll(PDO::FETCH_ASSOC);
        if(count($data2)==count($data1)){
                $consulta = "UPDATE usuario_cotizador SET estado_cotizador=true WHERE usuario_cotizador.user_cotizador='$nombre_usu'";        	
                $resultado = $conexion->prepare($consulta);
                $resultado->execute(); 
                
                $consulta = "UPDATE solicitudes_cotizaciones SET cantidad_cotizaciones = cantidad_cotizaciones + 1 WHERE id_solicitudes='$id_solicitud'";        	        
                $resultado = $conexion->prepare($consulta);
                $resultado->execute(); 
                $data='exito';        
        }
        
print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
?>