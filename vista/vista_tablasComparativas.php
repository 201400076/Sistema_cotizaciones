<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tablas Comparativas</title>
    <script src="../librerias/js/sweetalert2.all.min.js"></script>
    <script src="../librerias/js/jquery-3.6.0.js"></script>
</head>
<body>
    <?php
        $active = "";
        require_once '../vista/layouts/navegacionPendientes.php';
        require_once('../configuraciones/conexion.php');
        //$id_usuario=$_GET['id_usuario'];
        //$id_pedido=$_GET['id_pedido'];
        $id_solicitud=$_GET['id_solicitud'];

        $conn = new Conexiones();
        $estadoConexion = $conn->getConn();
        $cotizaciones = "SELECT * FROM solicitudes_cotizaciones WHERE id_solicitudes = ".$id_solicitud."";
        $queryCoti=$estadoConexion->query($cotizaciones);
        $registro=$queryCoti->fetch_array(MYSQLI_BOTH);
        //echo $registro['id_solicitud_cotizacion'];
        
        //Para probar se obtienen todas las empresas, se debe restringir a solo las empresas participantes en esta solicitud
        $empresas = "SELECT * FROM empresas";
        $queryEmpresas=$estadoConexion->query($empresas);
    ?>
    <h1 style="text-align: center;">Tablas Comparativas</h1><br><br>
    <h2 style="text-align: center;">Solicitud de Cotizacion #<?php echo $id_solicitud;?></h2><br><br>







    <div class="row">
        <div class="col-lg-12" style="text-align: center;">
            <label for="empresasCotizadoras">Seleccione la Empresa Adjudicada a la Cotizacion:</label><br>
            <select name="empresasCotizadoras" id="empresasCotizadoras">
                <?php
                    while($listaEmpresas=$queryEmpresas->fetch_array(MYSQLI_BOTH)){
                        $empresaActualNombre = $listaEmpresas['nombre_empresa'];
                        $idEmpresaActual = $listaEmpresas['id_empresa'];
                        echo "<option value=".$idEmpresaActual.">".$empresaActualNombre."</option>";
                    }
                ?>
            </select>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-12" style="text-align: center;">
            <button class="btn btn-success" id="botonAceptar">ACEPTAR</button>
            <button class="btn btn-danger" id="botonRechazar">RECHAZAR</button>
            <button class="btn btn-secondary" id="botonCancelar" value="Cancelar">CANCELAR</button>
        </div>
    </div>

    <script>
        var id = '<?php echo $_GET['id_solicitud']?>';
        //var id_pedido = '<?php // echo $_GET['id_pedido']?>';
        //var id_usuario = '<?php // echo $_GET['id_usuario']?>';
    </script>
    <script src="../controladores/evaluarCotizacion.js"></script>
</body>
</html>