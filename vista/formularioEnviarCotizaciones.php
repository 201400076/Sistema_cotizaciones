<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviar Correos</title>
    <link rel="stylesheet" href="./css/estiloRol.css">
    <script src="../librerias/js/sweetalert2.all.min.js"></script>
    <script src="../librerias/js/jquery-3.6.0.js"></script>
</head>
<body>
<?php
    $active = "";
    include_once("layouts/navegacion.php");

    require_once('../configuraciones/conexion.php');
    $conn = new Conexion();
    $estadoConexion = $conn->getConn();
    $empresas = "SELECT * FROM empresas";
    $queryEmpresas=$estadoConexion->query($empresas);
    
    //Se debe recuperar el id de la Solicitud
    $idSolicitud=$_GET["idSolicitud"];
?>
<div class="container-fluid">
    <div>
        <h2 style="text-align:center;">Envio de cotizaciones a empresas</h2>
    </div>
    <br>
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
                        <a style="width: 50%;" href="../archivos/cotizacionesIniciales/solicitudCotizacion<?php echo $idSolicitud ?>.pdf">Solicitud_de_cotizacion.pdf</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="descripcion" style="width: 25%;">Descripción:</label> 
                    <textarea name="descripcion" id="descripcion" style="width: 70%;"  cols="50%" rows="3" placeholder="Ingrese detalles..." required></textarea> 
                </div>
            </div>
        <div>
            <h3 style="text-align: center;">Lista de Empresas</h3>
        </div>
        <table id="tablaEmpresas">
            <thead>
                <tr>
                    <th>Codigo Empresa</th>
                    <th>Nombre Empresa</th>
                    <th>Correo Empresa</th>
                    <th>Accion</th>
                </tr>
            </thead>
            <tbody>
            <?php
            while($registroEmpresas=$queryEmpresas->fetch_array(MYSQLI_BOTH)){
                echo "<tr>
                        <td>".$registroEmpresas['id_empresa']."</td>
                        <td>".$registroEmpresas['nombre_empresa']."</td>
                        <td>".$registroEmpresas['correo_empresa']."</td>
                        <td><input type='checkbox' name='marcar[]' id='marcar' value=".$registroEmpresas['correo_empresa']."/></td>
                    </tr>";
                } 
            ?>						 
            </tbody>
        </table>			
        <div class="text-center">
            <button type="submit" name="enviar" class="btn btn-success" value="Marcar empresa">
                ENVIAR
            </button>
        </div>
        <script>
            var idSolicitud = '<?php echo($idSolicitud);?>';
        </script>
        <script src="../controladores/validarEnvioCorreos.js"></script>
    </form>
</div>
<?php
    include_once("../vista/layouts/footer.php");
?>
</body>
</html>