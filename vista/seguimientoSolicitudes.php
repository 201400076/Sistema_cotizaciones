<?php
    session_start();
    $unidadAdmin = $_SESSION['unidad'];
    include("layouts/navAdministracion.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <link href="../librerias/css/blue.css" id="theme" rel="stylesheet">
    <script src="../librerias/js/sweetalert2.all.min.js"></script>
    <script src="../librerias/js/jquery-3.6.0.js"></script>
    <title>Busqueda de Solicitudes</title>
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
    <!--    
    <div class="row">
        <div class="col-lg-12" style="margin-left: 15%;">
            <button class="btn btn-secondary" id="botonAtras" onclick="window.location.href='../ruta/rutas.php?ruta=mostrar&con=cotizando'" value="atras">ATRAS</button>
        </div>
    </div>
    -->

    <div class="container-fluid">
            <div class="col-md-12">
                <div class="card" >
                    <div class="card-body" >
                        <div class="row">
                                <div class="outer_div" style="width:90%;margin: auto;">
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
                    </div>    
                </div>
            </div>                                  
        </div>
    <div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"></div>  
    </div>
    <script src="../librerias/popper/popper.min.js"></script>
    <script src="../librerias/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../librerias/datatables/datatables.min.js"></script>    
    <script type="text/javascript" src="../controladores/controladorVistaDetalle.js"></script>  
</body>
<?php
    //include_once("../vista/layouts/piePagina.php");
?>
</html>
