<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilosSolicitud.css">
    <title>solicitud de pedido</title>
</head>
<body>
<?php
    $_POST["nro"]=1;
    $_POST["fecha"]=date("Y-m-d");
    $encargado="juan peres";
    $idPedido="pd-002";
    include('../modelo/conexionPablo.php');
    $registros=$conexion->query("SELECT items.cantidad, items.unidad, items.detalle, items.archivo FROM items, pedido WHERE items.id_pedido=pedido.id_pedido")->fetchAll(PDO::FETCH_OBJ);        
?>
    <h1>Solicitud de Pedido: # <?php echo $idPedido?></h1>
    <h2><?php echo $_POST["fecha"]?></h2>
    <h2> Solicitado por: <?php echo $encargado?></h2>
    <h2></h2>
    <form action="insertarSolicitud.php" method="post" enctype="multipart/form-data">
    <div id="tabla">
    <table id="tablaItems">
            <tr>
                <th class="primeraFila">Nro</th>
                <th class="primeraFila">Cantidad</th>
                <th class="primeraFila">Unidad</th>
                <th class="primeraFila">Detalle</th>
                <th class="primeraFila">Archivo</th>
                <th class="primeraFila">Eiminar</th>                
                
            </tr>
            <?php
                foreach ($registros as $registro):
            ?>
            <tr>
                    <td><?php
                     echo $_POST['nro'];
                     $_POST['nro']++;?></td>
                    <td><?php echo $registro->cantidad?></td>
                    <td><?php echo $registro->unidad?></td>
                    <td><?php echo $registro->detalle?></td>
                    <td><?php echo $registro->archivo?></td>    
                    <td><input type="button" name='eliminar' value='eliminar' id="borrar"></td>                            
            </tr>
            <?php
                endforeach
            ?>
            <td><input type="text" name='id' size='10' class='centrado' value="<?php echo $_POST['nro'];?>" readonly></td>
            <td><input type="number" name='cantidad' size='10' class='centrado' required></td>
            <td><input type="text" name='unidad' size='10' class='centrado' required></td>
            <td><input type="text" name='detalle' size='10' class='centrado'></td>
            <td><input type="file" name='archivo' id='archivo' value="adjuntar"></td>
            <td><input type="submit" name='cr' value='insertar' id="cr"></td>
        </table>
    </div>
    </form>
    <div id="justificacion">
        <textarea name="justificacion" id="just" name="just" class="just" cols="149" rows="10" placeholder="Justificacion del pedido.."></textarea>
    </div>
    <a href="enviarSolicitud.php?id=<?php echo $_POST['fecha']?>">
    <input type="button" id="enviarSolicitud" name="enviarSolicitud" value="enviar solicitud"></a>
</body>
</html>
