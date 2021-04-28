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
    $active="active";
    include_once("layouts/navegacion.php");
    ?>
<?php
    require_once("../modelo/solicitudes_modelo.php");
    $id_usuario=1;
    $pedidos=new Solicitudes();
    $registros=$pedidos->getItems($id_usuario);
    $_POST["nro"]=1;
    $_POST["fecha"]=date("Y-m-d");
    $encargado="juan peres";    
    $nro=$pedidos->getPedido($id_usuario);
    if(isset($_POST["cr"])){        
        $cantidad=$_POST["cantidad"];
        $unidad=$_POST["unidad"];;
        $detalle=$_POST["detalle"];;
        $archivo=$_FILES["archivo"]["name"];
        $ruta="C:\wamp64\www\proyectos";
        if(empty($unidad)){
            echo "<p>*Debe ingresar una unidad</p>";
        }
        $pedidos->addItemsPendientes($id_usuario,$cantidad,$unidad,$detalle,$archivo,$ruta);
    }
    if(isset($_POST["enviarSolicitud"])){
        $fecha=$_POST["fecha"];
        $justificacion=$_POST["just"];
        $pedidos->addPedido($fecha,$justificacion,$id_usuario);
    }
    
?>
    <h1>Solicitudsss de Pedido # <?php echo $nro?></h1>
    <h2><?php echo $_POST["fecha"]?></h2>
    <h2> Solicitado por: <?php echo $encargado?></h2>
    <h2></h2>
    <form action="" method="post" enctype="multipart/form-data">
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
                        <td><?php echo $registro->cantida?></td>
                        <td><?php echo $registro->unidad?></td>
                        <td><?php echo $registro->detalle?></td>
                        <td><?php echo $registro->archivo?></td>    
                        <td><input type="button" name='eliminar' value='eliminar' id="borrar"></td>                            
                </tr>
                <?php
                    endforeach
                ?>
                <td><input type="text" name='id' size='10' class='centrado' value="<?php echo $_POST['nro'];?>" readonly></td>
                <td><input type="number" name='cantidad' size='10' class='centrado'></td>
                <td><input type="text" name='unidad' size='10' class='centrado'></td>
                <td><input type="text" name='detalle' size='10' class='centrado'></td>
                <td><input type="file" name='archivo' id='archivo' value="adjuntar"></td>
                <td><input type="submit" name='cr' value='insertar' id="cr"></td>
            </table>
        </div>
        <div id="justificacion">
            <textarea id="just" name="just" class="just" cols="149" rows="10" placeholder="Justificacion del pedido.."></textarea>
        </div>
        <input type="submit" id="enviarSolicitud" name="enviarSolicitud" value="Enviar y guardar">
    </form>   
    <?php
        include_once("layouts/footer.php");
    ?>
</body>
</html>
