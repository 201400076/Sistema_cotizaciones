<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
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
    <title>Envio de Correos</title>
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
        #titulos{
            background-color: #055B91;
            color: white;
        }
    </style>  

</head>
<body class="fix-header card-no-border">
<?php
    $active = "";
    include_once("layouts/navegacionPendientes.php");

    require_once('../configuraciones/conexion.php');
    $conn = new Conexion();
    $estadoConexion = $conn->getConn();
    $empresas = "SELECT * FROM empresas";
    $queryEmpresas=$estadoConexion->query($empresas);
    
    //Se debe recuperar el id de la Solicitud
    $idSolicitud=$_GET["idSolicitud"];
?>
<div class="container-fluid">
    
    <h2 style="text-align:center;"><strong>ENVIO DE CORREOS</strong></h2>
  
    <form action="enviarCorreos.php?idSolicitud=<?php echo $idSolicitud?>" method="post" id="formulario">
        <div class="container">
            <div class="row">
                <div class="col-md-6" >
                    <div style="width: 100%;">
                        <label for="remitente" style="width: 25%;">Remitente:</label>  
                        <input name="remitente" id="remitente" type="text" style="width: 50%;" required><br>
                    </div>
                    <div>
                        <label for="asunto" style="width: 25%;">Asunto:</label>  
                        <input name="asunto" id="asunto" type="text" style="width: 50%;" required>
                    </div>
                    <div>
                        <label for="archivo" style="width: 25%;">Archivo adjunto:</label>  
                        <a style="width: 50%;" href="../archivos/cotizacionesIniciales/solicitudCotizacion<?php echo $idSolicitud ?>.pdf" target="_blank">Solicitud_de_cotizacion.pdf</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="descripcion" style="width: 25%;">Descripción:</label> 
                    <textarea name="descripcion" id="descripcion" style="width: 70%;"  cols="50%" rows="3" placeholder="Escriba el cuerpo del correo..." required></textarea> 
                </div>
            </div>

        <div class="row">
            <div class="col-lg-12">
                <h3 style="text-align: center;">Lista de Empresas</h3>
            </div>
        </div>

    <div class="container mt-4 mb-4">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaPersonas" class="table table-bordered table-condensed table-hover table-sm" style="width:100%">
                        <thead class="text-center">
                        <tr id="titulos">
                            <th>CODIGO EMPRESA</th>
                            <th>NOMBRE EMPRESA</th>
                            <th>CORREO</th>
                            <th>RUBRO</th>
                            <th>SELECCIONAR</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        while($registroEmpresas=$queryEmpresas->fetch_array(MYSQLI_BOTH)){
                            echo "<tr>
                                    <td>".$registroEmpresas['id_empresa']."</td>
                                    <td>".$registroEmpresas['nombre_empresa']."</td>
                                    <td>".$registroEmpresas['correo_empresa']."</td>
                                    <td>".$registroEmpresas['rubro']."</td>
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
    
</div>

    <script>
        var idSolicitud = '<?php echo($idSolicitud);?>';
    </script>
    <script src="../controladores/validarEnvioCorreos.js"></script>

    <script src="../librerias/popper/popper.min.js"></script>
    <script src="../librerias/bootstrap/js/bootstrap.min.js"></script>
      
    <!-- datatables JS -->
    <script type="text/javascript" src="../librerias/datatables/datatables.min.js"></script>    
    <script type="text/javascript" src="../controladores/controladorVistaDetalle.js"></script> 

<?php
    //include_once("../vista/layouts/footer.php");
?>
</body>
</html>