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
</head>
<body>
<?php
    require_once("../modelo/solicitudes_administracion.php");        
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
 <nav>
        <div class="titulo">
            <label>Sistema de Cotizaciones</label>
        </div>
        
        <div>
            <a href="">Home</a>            
        </div>
    </nav>
<form action="">    
    <div id="form-detalle">
    <h1>Solicitud de Cotizacion</h1>
    <h1>Expresado en bolivianos</h1>        
        <label>Unidad de administrativa: Laboratorio de informatica y sistemas</label><br>
        <label>Fecha de solicitud: 2021-04-20</label><br>        
        <div id="tabla">
            <table id="tablaItems">
                <tr>
                    <th class="primeraFila">Nro</th>
                    <th class="primeraFila">Cantidad</th>
                    <th class="primeraFila">Unidad</th>
                    <th class="primeraFila">Detalle</th>
                    <th class="primeraFila">Archivo</th>              
                    <th class="primeraFila">Precio Unit</th>              
                    <th class="primeraFila">Precio Parcial</th>  
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
                        <td>
                            <a target="_black" href="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/proyectos/'.$registro->ruta ?>"type='button'>Ver...</a>
                        </td>    
                        <td><input type="number" name='unitario' size='10' class='centrado' min="1" max="1000000"></td>
                        <td></td>                                                
                </tr>
                <?php
                    endforeach
                ?>
                 <tr>
                    <th class="primeraFila">Precio Total</th>
                    <th class="primeraFila"></th>
                    <th class="primeraFila"></th>
                    <th class="primeraFila"></th>
                    <th class="primeraFila"></th>
                    <th class="primeraFila"></th>
                    <th class="primeraFila">15555</th>  
                </tr>
            </table>
           
        </div>        
    </div>
</form>
<input type="submit" id="enviarSolicitud" name="enviarSolicitud" value="Enviar y guardar">
<script src="../controladores/evaluarPedidoSolicitud.js"></script>
</body>
</html>
