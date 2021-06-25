<?php
    require_once("../modelo/solicitudes_administracion.php");        
    $id_usuario=$_GET['id_usuario'];
    $id_pedido=$_GET['id_pedido'];
    $id_solicitud=$_GET['id_solicitud'];
    
    include_once '../modelo/conexionPablo.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();
    $id_pendientes=$id_usuario;
    $consulta="SELECT id_pedido,cantidad,unidad,detalle,archivo,ruta FROM items WHERE items.id_pedido='$id_pedido'";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

    $consulta="SELECT nombres,apellidos FROM usuarios WHERE usuarios.id_usuarios='$id_pendientes'";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data2=$resultado->fetchAll(PDO::FETCH_ASSOC);
    $nombre=$data2['0']['apellidos']." ".$data2['0']['nombres'];

    $consulta="SELECT nombres,apellidos FROM usuarios WHERE usuarios.id_usuarios='$id_pendientes'";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data2=$resultado->fetchAll(PDO::FETCH_ASSOC);
    $nombre=$data2['0']['apellidos']." ".$data2['0']['nombres'];

    $consulta="SELECT fecha,justificacion FROM pedido WHERE pedido.id_pedido='$id_pedido'";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data3=$resultado->fetchAll(PDO::FETCH_ASSOC);
    $fecha=$data3['0']['fecha'];

    $active = "active";

    $fechaActual = date('Y-m-d');
    $fechaLimite = date("Y-m-d",strtotime($fechaActual."+ 1 month")); 
?>
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
      
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../librerias/css/bootstrap.min.css">
    <!-- CSS personalizado --> 
    <!--<link rel="stylesheet" href="css/estilosSolicitud.css">  -->
      
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
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
                        <!-- Logo icon -->
                        <b>
                            <!-- Light Logo icon -->
                            <img src="../recursos/imagenes/icono.jpg" alt="homepage" class="light-logo" style="width:34px">
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span style="">

                            <!-- Light Logo text -->
                            <span class="text-white" style=""><b> Sistema de Cotizaciones </b></span>

                        </span>
                    </a>
                </div><a class="navbar-brand" href="index.php">
                    
                </a>
                <div class="navbar-collapse"><a class="navbar-brand" href="index.php">
                        
                    </a>
                    <ul class="navbar-nav mr-auto mt-md-0 "><a class="navbar-brand" href="index.php">
                            <!-- This is  -->
                        </a>
                        <li class="nav-item"><a class="navbar-brand" href="index.php"> </a><a
                                class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark"
                                href="javascript:void(0)"><i class="fa fa-bars"></i></a> </li>
                        <li class="nav-item"> <a
                                class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark"
                                href="javascript:void(0)"><i class="icon-arrow-left-circle"></i></a> </li>



                    </ul>

                    <ul class="navbar-nav my-lg-0">

                        <!-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="#"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                    class="fa fa-user"></i> Usuario</a>
                            <div class="dropdown-menu dropdown-menu-right animated flipInY">
                                <ul class="dropdown-user">
                                    <li>
                                        <div class="dw-user-box">
                                            <div class="u-img"><img src="" alt="user">
                                            </div>
                                            <div class="u-text">
                                                <h4>Nombre Usuario</h4>
                                                <p class="text-muted">info@usuario.com</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="usuarios.php?profile=1"><i class="ti-user"></i> Mi Perfil</a></li>
                                    <li><a href="cotizaciones.php?type=1"><i class="ti-wallet"></i> Mis cotizaciones</a>
                                    </li>

                                    <li role="separator" class="divider"></li>

                                    <li><a href="login.php?logout"><i class="fa fa-power-off"></i> Cerrar sesión</a>
                                    </li>
                                </ul>
                            </div>
                        </li> -->

                    </ul>
                </div>
            </nav>
        </header> <!-- ============================================================== -->

        <aside class="left-sidebar" method="get">
        
            <div class="scroll-sidebar">
             
                <nav class="sidebar-nav active">
                    <ul id="sidebarnav" class="in">
                      <!--   <li class="nav-small-cap">PERSONAL</li>
                        <li class="active" id="inicio">
                            <a class="has-arrow active" href="homkke.php" aria-expanded="false"><i
                                    class="mdi mdi-gauge"></i><span class="hide-menu">Inicio </span></a>

                        </li>
                        <li>
                            <a class="has-arrow " href="cotizaciones.php" aria-expanded="false"><i
                                    class="mdi mdi-shopping"></i><span class="hide-menu">Cotizaciones</span></a>

                        </li>

                        <li>
                            <a class="has-arrow " href="clientes.php" aria-expanded="false"><i
                                    class="mdi mdi-contact-mail"></i><span class="hide-menu">Clientes</span></a>

                        </li> -->
                        <li class="<?php echo $active?>">
                            <a class="has-arrow <?php echo $active?> " href="#" aria-expanded="false"><i class="mdi mdi-barcode"></i><span
                                    class="hide-menu">Home</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li ><a href="../ruta/ruta.php" id="nueva" name="nueva">Home</a></li>
                            </ul>
                        </li>
                        <li class="<?php echo $active?>">
                            <a class="has-arrow <?php echo $active?> " href="#" aria-expanded="false"><i class="mdi mdi-barcode"></i><span
                                    class="hide-menu">Solicitudes</span></a>
                            <ul aria-expanded="false" class="collapse">
<!-- <<<<<<< HEAD -->
                                <li ><a href="../ruta/rutas.php?ruta=mostrar&con=nueva" id="nueva" name="nueva">Solicitudes Pendientes</a></li>
                                <li><a href="../ruta/rutas.php?ruta=mostrar&con=aceptada">Solicitudes Aceptadas</a></li>
								<li><a href="../ruta/rutas.php?ruta=mostrar&con=rechazada">Solicitudes Rechazadas</a></li>
                                
<!-- ======= -->
                                 <!-- <li ><a href="../vista/formularioRU.php" id="nueva" name="nueva">usuario</a></li>  -->
                                <!-- <li><a href="../ruta/rutas.php?ruta=mostrar&con=aceptada">Solicitudes Aceptadas</a></li>
								<li><a href="../ruta/rutas.php?ruta=mostrar&con=rechazada">Solicitudes Rechazadas</a></li> -->
<!-- >>>>>>> 7af3d9df64eeef8eeb31cbb131604d9d55fe7036 -->

                            </ul>
                        </li>

                   
<!-- 
                        <li>
                            <a class="has-arrow " href="#" aria-expanded="false"><i
                                    class="mdi mdi-account-settings-variant"></i><span class="hide-menu">Administrar
                                    accesos</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="usuarios.php">Usuarios</a></li>
                                <li><a href="group_list.php">Roles de usuario</a></li>

                            </ul>
                        </li> -->

                     <!--    <li>
                            <a class="has-arrow " href="#" aria-expanded="false"><i class="mdi mdi-settings"></i><span
                                    class="hide-menu">Configuración</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="empresa.php">Perfil de la empresa</a></li>
                                <li><a href="monedas.php">Monedas</a></li>
                                <li><a href="impuestos.php">Impuestos</a></li>
                                <li><a href="plantillas.php">Plantillas</a></li>
                            </ul>
                        </li> -->
                    </ul>
                </nav>
                
            </div>
         
        </aside>
    
    
        <div class="page-wrapper" style="min-height: 600px;"> <!-- 352 -->


    <section class="mt-4">
        <div class="row">
            <div class="col-lg-12">
                <h2>Solicitado por:  <?php echo $nombre?></h2>
            </div>
            <div class="col-lg-12">
                <h2>Fecha de solicitud:  <?php echo $fecha?></h2>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <button id="btnNuevo" type="button" class="btn btn-dark" data-toggle="modal">Justificacion</button>    
            </div>    
        </div>    
    </div> 

    <div class="container mt-4 mb-4">
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
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {                                                        
                            ?>                            
                            <tr>
                                <td><?php echo $dat['id_pedido'] ?></td>
                                <td><?php echo $dat['cantidad'] ?></td>
                                <td><?php echo $dat['unidad'] ?></td>
                                <td><?php echo $dat['detalle'] ?></td>                                  
                                <td><a target='_black' href="/Sistema_cotizaciones/<?php echo $dat['ruta']?>" type='button'> <?php echo $dat['archivo']?> </a>        
                                </td>
                            </tr>
                            <?php
                                }
                            ?>                                
                        </tbody>        
                       </table>                    
                    </div>
                </div>
        </div>  
    </div>    


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
                        
                    <?php 
                    if($data3['0']['justificacion']==''){
                        echo "<p class='text-secondary'>No hay ninguna justificacion!!!</p>";
                    }else{
                        echo "<p>".$data3['0']['justificacion']."</p>";
                    }                
                    ?>
                    </p>                  
                    
                </div>                           
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light btn-block" data-dismiss="modal">Atras</button>                
            </div>
        </form>    
        </div>
    </div>
</div>  


<!-- MARCO  -->

<div class="row">
    <div class="col-lg-12" style="text-align: center;">
        <br>
        <button class="btn btn-success" id="botonAceptar">ACEPTAR</button>
        <button class="btn btn-danger" id="botonRechazar">RECHAZAR</button>
        <button class="btn btn-secondary" id="botonCancelar" value="Cancelar">CANCELAR</button>
    </div>
</div>

<script>
    var id = '<?php echo $_GET['id_solicitud']?>';
    var id_pedido = '<?php echo $_GET['id_pedido']?>';
    var id_usuario = '<?php echo $_GET['id_usuario']?>';

</script>
<script src="../controladores/evaluarPedidoSolicitud.js"></script>



<!--
    <script src="../librerias/jquery/jquery-3.3.1.min.js"></script>-->
    <script src="../librerias/popper/popper.min.js"></script>
    <script src="../librerias/bootstrap/js/bootstrap.min.js"></script>
      
    <!-- datatables JS -->
    <script type="text/javascript" src="../librerias/datatables/datatables.min.js"></script>    
     
    <script type="text/javascript" src="../controladores/controladorVistaDetalle.js"></script>  
    </div>

</div>



<!--Menu sidebar -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/sticky-kit/1.1.3/sticky-kit.min.js"></script>
<script src="../librerias/js/custom.min.js"></script>
</body>
</html>