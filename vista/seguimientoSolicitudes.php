<?php
    //include("layouts/navAdministracion.php");
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
    <title>Busqueda de Solicitudes</title>
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

    <style>
        td{
            text-align: center;
            height: auto;
        }
    </style>  
</head>
<body class="fix-header card-no-border">
    <?php
        session_start();
        $unidadAdmin = $_SESSION['unidad'];

        require_once('../configuraciones/conexion.php');
        $conn = new Conexiones();
        $estadoConexion = $conn->getConn();
        $solicitudes = "SELECT * FROM solicitudes, pedido, usuarios, usuarioconrol, unidad_gasto, unidad_administrativa WHERE (solicitudes.estado='pendiente' OR solicitudes.estado='rechazada')
                                AND solicitudes.id_pedido=pedido.id_pedido AND  pedido.id_unidad=unidad_gasto.id_unidad AND usuarioconrol.id_gasto=unidad_gasto.id_gasto AND usuarios.id_usuarios=pedido.id_usuarios 
                                AND usuarios.id_usuarios=usuarioconrol.id_usuarios AND unidad_administrativa.id_unidad=pedido.id_unidad 
                                AND pedido.id_unidad=".$unidadAdmin." order by pedido.fecha desc";
        $querySolicitudes=$estadoConexion->query($solicitudes);

        $cotizaciones = "SELECT * FROM solicitudes_cotizaciones, pedido, solicitudes WHERE solicitudes_cotizaciones.id_solicitudes=solicitudes.id_solicitudes
                                    AND pedido.id_unidad=".$unidadAdmin." AND solicitudes.id_pedido=pedido.id_pedido";
        $queryCotizaciones=$estadoConexion->query($cotizaciones);
    ?>

    <section class="mt-4">
        <div class="row">
            <div class="col-lg-12">
                <h2>Busqueda de Cotizaciones</h2>
            </div>
        </div>
    </section>

    <div class="row">
        <div class="col-lg-12" style="margin-left: 15%;">
            <button class="btn btn-secondary" id="botonAtras" onclick="window.location.href='../ruta/rutas.php?ruta=mostrar&con=cotizando'" value="atras">ATRAS</button>
        </div>
    </div>

    <div class="container mt-4 mb-4">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaPersonas" class="table table-striped table-bordered table-condensed table-hover table-sm" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th># SOLICITUD</th>
                                <th>TIPO DE SOLICITUD</th>
                                <th>ESTADO</th>
                                <th>ACCION</th>                                                              
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        function direccionar($tipo, $estado){
                            $res = '';
                            if($tipo == 'pedido'){
                                if($estado == 'aceptada'){
                                    $res = '../ruta/rutas.php?ruta=mostrar&con=aceptada';
                                }else if($estado == 'rechazada'){
                                    $res = '../ruta/rutas.php?ruta=mostrar&con=rechazada';
                                }else if($estado == 'pendiente'){
                                    $res ='../ruta/rutas.php?ruta=mostrar&con=nueva';
                                }  
                            }else if($tipo == 'cotizacion'){
                                if($estado == 'aceptada'){
                                    $res = '../vista/vista_cotizaciones_aceptadas.php';
                                }else if($estado == 'rechazada'){
                                    $res = '../vista/vista_cotizaciones_rechazadas.php';
                                }else if($estado == 'cotizando'){
                                    $res = '../ruta/rutas.php?ruta=mostrar&con=cotizando';
                                }
                            }  
                            return $res;    
                        }

                        while($registroSolicitudes=$querySolicitudes->fetch_array(MYSQLI_BOTH)){
                            echo "<tr>
                                    <td>".$registroSolicitudes['id_solicitudes']."</td>
                                    <!-- <td>".$registroSolicitudes['fecha_evaluacion']."</td> -->
                                    <td>Solicitud de Pedido</td>
                                    <td>".$registroSolicitudes['estado']."</td>
                                    <td><a class='btn btn-info' target='_top' href=".direccionar('pedido',$registroSolicitudes['estado']).">REVISAR</a></td>
                                </tr>";
                        }
                        while($registroCotizaciones=$queryCotizaciones->fetch_array(MYSQLI_BOTH)){
                            echo "<tr>
                                    <td>".$registroCotizaciones['id_solicitudes']."</td>
                                    <!-- <td>".$registroCotizaciones['fecha_evaluacion']."</td> -->
                                    <td>Solicitud de Cotizacion</td>
                                    <td>".$registroCotizaciones['estado_cotizacion']."</td>
                                    <td><a class='btn btn-info' target='_top' href=".direccionar('cotizacion',$registroCotizaciones['estado_cotizacion']).">REVISAR</a></td>
                                </tr>";
                        } 
                        ?>						 
                        </tbody>         
                       </table>                    
                    </div>
                </div>
        </div>  
    </div>    


    <div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
</div>  
    </div>
    <script src="../librerias/popper/popper.min.js"></script>
    <script src="../librerias/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../librerias/datatables/datatables.min.js"></script>    
    <script type="text/javascript" src="../controladores/controladorVistaDetalle.js"></script>  
    
</body>

</html>
<?php
    //include_once("../vista/layouts/piePagina.php");
?>