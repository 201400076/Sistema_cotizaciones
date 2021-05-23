<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../librerias/js/sweetalert2.all.min.js"></script>
    <script src="../librerias/js/jquery-3.6.0.js"></script>
    <title>Document</title>
    <link rel="stylesheet" href="css/estilosSolicitud.css">

    <style>
         .botones{
            width: auto;
            margin-top: 100px;
            text-align: center;
        }
        
        button{
            display: inline-block;
        }
    </style>

</head>
<body>
<?php
    $id_usuario=1;

    $id_pedido=81;
    $id_solicitud=25;
    $monto_solicitud=5000;
    $monto_unidad=200000;

    require_once("../modelo/solicitudes_modelo.php");   
    $pedidos=new Solicitudes();
    $registros=$pedidos->getItemsPedido($id_usuario,$id_pedido,$id_solicitud);
    $just=$pedidos->getJustificacion($id_usuario,$id_pedido,$id_solicitud);
    $_POST["nro"]=1;
    
?>
<form action="">    
    <div id="form-detalle">
        <label>Solicitado por: Montecinos Gomez Juan Pablo</label><br>
        <label>Unidad de gasto: Laboratorio de informatica y sistemas</label><br>
        <label>Fecha de solicitud: 2021-04-20</label><br>
        <label> Monto de la unidad administrativa: Bs. 200000.-</label><br>
        <label> Monto del pedido: Bs. 5000.-</label>
        <div id="tabla">
            <table id="tablaItems">
                <tr>
                    <th class="primeraFila">Nro</th>
                    <th class="primeraFila">Cantidad</th>
                    <th class="primeraFila">Unidad</th>
                    <th class="primeraFila">Detalle</th>
                    <th class="primeraFila">Archivo</th>              
                    <th class="primeraFila">Accion</th>              
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
                        <td>
                            <a target="_black" href="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/proyectos/'.$registro->ruta?>" type="button">Ver...</a>
                        </td>    
                </tr>
                <?php
                    endforeach
                ?>
            </table>
        </div>
        <textarea name="justificacion" id="justificacion" cols="30" rows="10"><?php echo $just?></textarea>
    </div>
</form>

<!-- MARCO  -->
    <?php
        if(isset($_POST["ej"])){
            
        }
    ?>
    <input type="submit" id="ej">

<div class="botones">
    <button id="botonAceptar">Aceptar</button>
    <button id="botonRechazar">Rechazar</button>
    <button id="botonCancelar">Cancelar</button>
</div>

<script>
    var id = '<?php echo($id_solicitud);?>';
    var montoSolicitud = '<?php echo($monto_solicitud);?>';
    var montoUnidad = '<?php echo($monto_unidad);?>';
</script>
<script src="../controladores/evaluarPedidoSolicitud.js"></script>
</body>
</html>