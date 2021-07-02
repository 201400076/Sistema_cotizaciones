<?php
    include_once '../modelo/conexionPablo.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();
    $consulta="SELECT i.id_items,i.cantidad, i.unidad,i.detalle,i.archivo,i.ruta FROM solicitudes s, pedido p, items i WHERE (s.id_pedido=p.id_pedido && p.id_pedido=i.id_pedido) && s.id_solicitudes='32'";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

    var_dump($data);

    $consulta="SELECT * FROM `cotizacion_items` WHERE id_solicitudes=32";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data1=$resultado->fetchAll(PDO::FETCH_ASSOC);
    var_dump($data1);
    
    foreach($data as $a){
        $id=$a['id_items'];
        echo $a['id_items'].'--';
        foreach($data1 as $d){
            if($d['id_items']==$id){
                echo $d['precio_parcial'].' -';
            }
        }
        echo '<br>';
    }
?>