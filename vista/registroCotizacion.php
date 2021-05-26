<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->    
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    
    <!-- Custom CSS -->
    <link href="../librerias/css/styles.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="../librerias/css/blue.css" id="theme" rel="stylesheet">
    <link rel="icon" href="assets/images/cart_icon2.png">
    <!--alerts CSS -->
 
    <link href="../librerias/css/topbar.css">
    <link rel="stylesheet" href="../librerias/css/miestilo.css">
    <link rel="stylesheet" href="../librerias/css/miestilogasto.css">
    
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <script src="../librerias/js/sweetalert2.all.min.js"></script>
    <script src="../librerias/js/jquery-3.6.0.js"></script>
    <title>solicitud de pedido</title>
    <link rel="stylesheet" href="css/estilosSolicitud.css?v=<?php echo(rand()); ?>" />
</head>
<body class="fix-header card-no-border">   
    <div class="preloader" style="display: none;">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"></circle>
        </svg>
    </div>
    <div id="main-wrapper">
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">    
                <div class="navbar-header">
                    <a class="navbar-brand">                        
                        <b><img src="../recursos/imagenes/icono.jpg" alt="homepage" class="light-logo" style="width:34px"></b>                        
                        <span style="">                            
                            <span class="text-white" style=""><b> Sistema de Cotizaciones </b></span>
                        </span>
                    </a>
                </div>              
            </nav>
        </header>
        <aside class="left-sidebar" method="get">        
            <div class="scroll-sidebar">             
                <nav class="sidebar-nav active">
                    <ul id="sidebarnav" class="in">                     
                        <li class="active">                            
                            <ul aria-expanded="false" class="collapse">
                                <li ><a href="../ruta/ruta.php" id="nueva" name="nueva">Home</a></li>
                            </ul>
                        </li>
                        <li class="active">                           
                            <ul aria-expanded="false" class="collapse">
                                <li ><a href="../ruta/rutas.php?ruta=mostrar&con=nueva" id="nueva" name="nueva">Solicitudes Nuevas</a></li>                            
                            </ul>
                        </li>
                    </ul>
                </nav>                
            </div>         
        </aside>        
    <div class="page-wrapper" style="min-height: 600px;">  
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
