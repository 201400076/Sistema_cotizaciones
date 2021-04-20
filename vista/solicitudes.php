<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>solicitud de pedido</title>
</head>
<body>
<?php
    $encargado="juan peres";
    $idPedido="pd-002";
    include('../modelo/conexion.php');
    $registros=$conexion->query("SELECT items.id_items, items.cantidad, items.unidad, items.detalle, items.archivo FROM items, pedido WHERE items.id_pedido=pedido.id_pedido")->fetchAll(PDO::FETCH_OBJ);    
?>
    <h1>solicitud de pedido <?php echo $idPedido?></h1>
    <input type="date" id="fecha" name="fecha"  value="<?php echo date("Y-m-d");?>">
    <h2> Solicitado por: <?php echo $encargado?></h2>
    <h2></h2>
    <form action="insertarSolicitud.php" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td class="primeraFila">Nro</td>
                <td class="primeraFila">Cantidad</td>
                <td class="primeraFila">Unidad</td>
                <td class="primeraFila">Detalle</td>
                <td class="primeraFila">Seleccionar archivo</td>
                
            </tr>
            <?php
                foreach ($registros as $registro):
            ?>
            <tr>
                    <td><?php echo $registro->id_items?></td>
                    <td><?php echo $registro->cantidad?></td>
                    <td><?php echo $registro->unidad?></td>
                    <td><?php echo $registro->detalle?></td>
                    <td><?php echo $registro->archivo?></td>                                
            </tr>
            <?php
                endforeach
            ?>
            <td><input type="text" name='id' size='10' class='centrado' required></td>
            <td><input type="number" name='cantidad' size='10' class='centrado' required></td>
            <td><input type="text" name='unidad' size='10' class='centrado' required></td>
            <td><input type="text" name='detalle' size='10' class='centrado'></td>
            <td><input type="file" name='archivo' id='archivo' value="adjuntar"></td>
            <td><input type="submit" name='cr' value='insertar' id="cr"></td>
        </table>
    </form>
    <div>
        <textarea name="justificacion" id="just" name="just" class="just" cols="100" rows="10"></textarea>
    </div>
    <a href="enviarSolicitud.php?id=<?php echo $idPedido?>">
    <input type="button" id="enviarSolicitud" name="enviarSolicitud" value="enviar solicitud"></a>
    
    <h1>Proyecto</h1>
</body>
</html>