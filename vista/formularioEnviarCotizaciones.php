<?php
    session_start();
    $unidadAdmin = $_SESSION['unidad'];
    $nombre = $_SESSION['nombre_usuario'];
    include("layouts/navAdministracion.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link href="../librerias/css/blue.css" id="theme" rel="stylesheet">   
    <script src="../librerias/js/sweetalert2.all.min.js"></script>
    <script src="../librerias/js/jquery-3.6.0.js"></script>
    <title>Envio de Correos</title>
    <link rel="stylesheet"  type="text/css" href="../librerias/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css"> 
    <style>
        td{
            text-align: center;
            height: auto;
        }
        #titulos{
            background-color: #055B91;
            color: white;
        }
    </style>  
</head>
<body>
<?php
    require_once('../configuraciones/conexion.php');
    $conn = new Conexiones();
    $estadoConexion = $conn->getConn();
    $empresas = "SELECT * FROM empresas, rubros WHERE rubros.id_rubro=empresas.rubro";
    $queryEmpresas=$estadoConexion->query($empresas);
    $idSolicitud=$_GET["idSolicitud"];
    $fechas = "SELECT fecha_ini_licitacion, fecha_fin_licitacion FROM solicitudes_cotizaciones WHERE id_solicitudes=".$idSolicitud;
    $queryFechas = $estadoConexion->query($fechas);
    $registroFechas=$queryFechas->fetch_array(MYSQLI_BOTH);
    $fIni = $registroFechas['fecha_ini_licitacion'];
    $fFin = $registroFechas['fecha_fin_licitacion'];   
?>
    <h2 style="text-align:center;"><strong>ENVIO DE CORREOS</strong></h2>
  
    <form action="enviarCorreos.php?idSolicitud=<?php echo $idSolicitud.'&ff='.$fFin?>" method="post" id="formulario">
        <div style="width: 98%; margin-left: 2%;">
            <div class="row">
                <div class="col-md-6" >
                    <div style="width: 100%;">
                    <label for="remitente" style="width: 100%; padding: 0;margin: 0;">Remitente : <strong style="font-style: italic; font-size: 18px; color: black;"><?php echo $nombre;?></strong></label>
                    </div>
                    <div>
                        <label for="fecInicio" style="width: 100%; padding: 0;margin: 0;">Fecha Inicio Cotizaciones     : <strong style="font-style: italic; font-size: 18px; color: black;"><?php echo $fIni; ?></strong></label>  
                        <label for="fecFin" style="width: 100%; padding: 0;margin: 0;">Fecha Fin Cotizaciones     : <strong style="font-style: italic; font-size: 18px; color: black;"><?php echo $fFin;?></strong></label>  
                    </div>
                    <div>
                        <label for="archivo" style="width: 20%; padding: 0;margin: 0;">Archivo adjunto:</label>  
                        <a style="width: 50%;" href="../archivos/cotizacionesIniciales/solicitudCotizacion<?php echo $idSolicitud ?>.pdf" target="_blank">Solicitud_de_cotizacion.pdf</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="asunto" style="width: 25%;">Asunto:</label>  
                    <input name="asunto" id="asunto" type="text" style="width: 70%; padding: 0;margin: 0;border-radius: 5px;" required>
                    <label for="descripcion" style="width: 25%;; padding: 0;margin: 0;">Descripción:</label> 
                    <textarea name="descripcion" id="descripcion" style="width: 70%; padding: 0;margin: 0;border-radius: 5px;"  cols="50%" rows="2" placeholder="Escriba el cuerpo del correo..." required></textarea> 
                </div>
            </div>
            <hr>
        <!--
        <div class="row">
            <div class="col-lg-12">
                <h3 style="text-align: center; padding: 0;margin: 0;">Lista de Empresas</h3>
            </div>
        </div>
        -->

    <div class="mt-4 mb-4">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaPersonas" class="table table-bordered table-condensed table-hover table-sm" style="width:100%">
                        <thead class="text-center">
                        <tr id="titulos">
                            <th>ID</th>
                            <th>NOMBRE EMPRESA</th>
                            <th>CORREO</th>
                            <th>RUBRO</th>
                            <th>ELEGIR</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        while($registroEmpresas=$queryEmpresas->fetch_array(MYSQLI_BOTH)){
                            echo "<tr>
                                    <td>".$registroEmpresas['id_empresa']."</td>
                                    <td>".$registroEmpresas['nombre_empresa']."</td>
                                    <td>".$registroEmpresas['correo_empresa']."</td>
                                    <td>".$registroEmpresas['nombre_rubro']."</td>
                                    <td><input type='checkbox' name='marcar[]' id='marcar' value=".$registroEmpresas['correo_empresa']."/></td>
                                </tr>";
                            } 
                        ?>						 
                        </tbody>         
                       </table> 
                                          
                    </div>
                </div>
        </div>  
    </div>    

    <div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"></div>  
    </form>                      

    <div class="row">
        <div class="col-lg-12" style="text-align: center;">
            <button type="submit" name="enviar" class="btn btn-success" value="Marcar empresa">
                ENVIAR
            </button>
            <button name="enviar" class="btn btn-danger" value="Cancelar" onclick="location.href = '../ruta/rutas.php?ruta=mostrar&con=aceptada';">
                CANCELAR
            </button>
        </div>
    </div>

    <script>
        var idSolicitud = '<?php echo($idSolicitud);?>';
    </script>
    <script src="../controladores/validarEnvioCorreos.js"></script>

    <script src="../librerias/popper/popper.min.js"></script>
    <script src="../librerias/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../librerias/datatables/datatables.min.js"></script>    
    <script type="text/javascript" src="../controladores/controladorVistaDetalle.js"></script> 
<?php
    include_once("../vista/layouts/piePagina.php");
?>
</body>
</html>