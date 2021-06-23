<?php
    include_once '../modelo/conexionPablo.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();
    $id_pendientes=1;
    $consulta="SELECT max(pedido.id_pedido) from pedido where pedido.id_usuarios='$id_pendientes'";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data1=$resultado->fetchAll(PDO::FETCH_ASSOC);
    $nro=$data1['0']['max(pedido.id_pedido)']+1;
    
    $consulta="SELECT nombres,apellidos FROM usuarios WHERE usuarios.id_usuarios='$id_pendientes'";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data2=$resultado->fetchAll(PDO::FETCH_ASSOC);
    $nombre=$data2['0']['apellidos']." ".$data2['0']['nombres'];

    $consulta="SELECT id_pendientes,cantidad, unidad, detalle,archivo,ruta FROM items_pendientes WHERE items_pendientes.id_usuarios='$id_pendientes'";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
    $active = "active";
    
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="#" />  
    <title>Tutorial DataTables</title>
    <link rel="icon" href="assets/images/cart_icon2.png">

    <link href="../librerias/css/styles.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="../librerias/css/blue.css" id="theme" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../librerias/css/bootstrap.min.css">
    <!-- CSS personalizado --> 
    <link rel="stylesheet" href="css/estilosSolicitud.css">  
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/javascript" href="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
    <!--datables CSS básico-->
    <link rel="stylesheet" type="text/css" href="../librerias/datatables/datatables.min.css"/>
    <!--datables estilo bootstrap 4 CSS-->  
    <link rel="stylesheet"  type="text/css" href="../librerias/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">       
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
                   <a class="navbar-brand" href="index.php">                       
                       <b>                           
                           <img src="../recursos/imagenes/icono.jpg" alt="homepage" class="light-logo" style="width:34px">
                       </b>
                       <span style="">
                           <span class="text-white" style=""><b> Sistema de Cotizaciones </b></span>
                       </span>
                   </a>
               </div><a class="navbar-brand" href="index.php"></a>
               <div class="navbar-collapse"><a class="navbar-brand" href="index.php"></a>
                   <ul class="navbar-nav mr-auto mt-md-0 "><a class="navbar-brand" href="index.php"></a>
                       <li class="nav-item"><a class="navbar-brand" href="index.php"> </a><a
                               class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark"
                               href="javascript:void(0)"><i class="fa fa-bars"></i></a> </li>
                       <li class="nav-item"> <a
                               class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark"
                               href="javascript:void(0)"><i class="icon-arrow-left-circle"></i></a> </li>
                   </ul>
                   <ul class="navbar-nav my-lg-0">
                   </ul>
               </div>
           </nav>
       </header> 
       <aside class="left-sidebar" method="get">
           <div class="scroll-sidebar">
               <nav class="sidebar-nav active">
                   <ul id="sidebarnav" class="in">
                       <li class="<?php echo $active?>">
                           <a class="has-arrow <?php echo $active?> " href="#" aria-expanded="false"><i class="mdi mdi-barcode"></i><span
                                   class="hide-menu">Home</span></a>
                           <ul aria-expanded="false" class="collapse">
                               <li ><a href="../ruta/ruta.php" id="nueva" name="nueva">Home</a></li>
                           </ul>
                       </li>                       
                   </ul>
               </nav>
           </div>
       </aside>
       <div class="page-wrapper" style="min-height: 600px;"> <!-- 352 -->

    <section>
        <div class="row">
            <div class="col-lg-12">
                <h2>Solicitud de Pedido # <?php echo $nro?></h2>
            </div>
            <div class="col-lg-12">
                <h2>Solicitado por:  <?php echo $nombre?></h2>
            </div>
            <div class="col-lg-12">
                <h2>Fecha:  <?php echo date('y-m-d')?></h2>
            </div>
        </div>
    </section>
      
    <div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <button id="btnNuevo" type="button" class="btn btn-success" data-toggle="modal">NUEVO ITEM</button>    
            </div>    
        </div>    
    </div>    
    <br>  
    <div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaPersonas" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>id_pendientes</th>
                                <th>cantidad</th>
                                <th>unidad</th>                                
                                <th>detalle</th>  
                                <th>archivo</th>  
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {                                                        
                            ?>                            
                            <tr>
                                <td><?php echo $dat['id_pendientes'] ?></td>
                                <td><?php echo $dat['cantidad'] ?></td>
                                <td><?php echo $dat['unidad'] ?></td>
                                <td><?php echo $dat['detalle'] ?></td>
                                <td><?php echo $dat['archivo'] ?></td>    
                                <td></td>
                            </tr>
                            <?php
                                }
                            ?>                                
                        </tbody>        
                       </table>                    
                    </div>
                </div>
        </div>  
        <div class="container">
            <div class="form-group" style="width:100%">    
                <div class="col-12">
                    <button type="button" id="btnPedido" class="btn btn-dark text-center btn-block mt-2 mb-8 btnPedido" data-toggle="modalJust">ENVIAR Y GUARDAR</button>
                </div>
            </div>
        </div>
    </div>    
      
<!--Modal para CRUD-->
<div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formPersonas">    
            <div class="modal-body">
                <div class="form-group">
                <label for="cantidad" class="col-form-label">CANTIDAD:</label>
                <input type="number" class="form-control" id="cantidad" placeholder="CANTIDAD*">
                </div>
                <div class="form-group">
                <label for="unidad" class="col-form-label">UNIDAD:</label>
                <input type="text" class="form-control" id="unidad" placeholder="UNIDAD*">
                </div>                
                <div class="form-group">
                <label for="detalle" class="col-form-label">DETALLE:</label>
                <textarea  class="form-control"  id="detalle" cols="20" rows="5" placeholder="Detalle de item..."></textarea>                
                </div>   
                <div class="form-group">
                <label for="unidad" class="col-form-label">archivo:</label>
                <input type="file" class="form-control" id="archivo">
                </div>           
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">CANCELAR</button>
                <button type="submit" id="btnGuardar" class="btn btn-dark">INSERTAR</button>
            </div>
        </form>    
        </div>
    </div>
</div>  

<div class="modal fade" id="modalCRUDJust" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class=" text-center modal-title1" id="exampleModalLabel">Enviar Solicitud de Pedido</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formPersonas">    
            <div class="modal-body">            
                <div class="form-group">
                <label for="Justificacion" class="col-form-label">Justificacion:</label>
                <textarea  class="form-control"  id="Justificacion" cols="20" rows="5" placeholder="Puede agregar una justificacion..."></textarea>                
                </div>                         
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">CANCELAR</button>
                <button type="button" id="btnGuardarJust" class=" btnGuardarJust btn btn-dark">GUARDAR</button>
            </div>
        </form>    
        </div>
    </div>
</div>  
<footer class="footer mt-8">
                © Sitio web desarrollado y gestionado por la grupo empresa <a 
                    target="_blank">PF S.R.L</a> 
                    <div class="text-center">
                        contactos:(+591) 76436540 – 44355215	
                    </div>
                </footer>
       
        </div>

    </div>
      
    <!-- jQuery, Popper.js, Bootstrap JS -->
    <script src="../librerias/jquery/jquery-3.3.1.min.js"></script>
    <script src="../librerias/popper/popper.min.js"></script>
    <script src="../librerias/bootstrap/js/bootstrap.min.js"></script>
      
    <!-- datatables JS -->
    <script type="text/javascript" src="../librerias/datatables/datatables.min.js"></script>    
     <script>
        var id_usu=<?php echo $id_pendientes?>
     </script>
    <script type="text/javascript" src="../controladores/controladorSolicitudPedido.js"></script>  
    
    </div>

</div>



<!--Menu sidebar -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/sticky-kit/1.1.3/sticky-kit.min.js"></script>
<script src="../librerias/js/custom.min.js"></script>
  </body>
</html>
