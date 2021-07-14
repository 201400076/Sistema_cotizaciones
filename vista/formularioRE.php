<?php
    session_start();
    $unidadAdmin = $_SESSION['unidad'];
    include("layouts/navAdministracion.php");
    require_once '../configuraciones/conexion.php';
    $conn = new Conexiones();
    
?>
<!DOCTYPE html>
<html>
<head>
	<title>Formulario Registro de Empresa</title>
	<meta charset="utf-8"/>
	<meta name="description"/>
    <link rel="stylesheet" type="text/css" href="../vista/css/estiloFRU.css" media="screen" />
	<style>
        
        input[type=button]{
        width: 90%;
        background-color: #c93030;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-decoration: solid;
        }
    
        input[type=button]:hover {
        background-color: #d65b5b;
        }
	</style>

</head>
<body>
    <div class="container" style="width: 650px;margin-top: 0;">
        
        <h2>Formulario de Registro de Empresa</h2>
        
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
            <div class="row">
                <div class="col-25">
                    <label for="nombre">Nombre Empresa:</label>
                </div>
                <div class="col-75">
                    <input type="text" id="nombre" name="nombre"  value="<?php echo isset($_POST['nombre']) ? $_POST['nombre'] : '';?>" required>

                </div>
            </div>

            <div class="row">
                <div class="col-25">
                    <label for="correo">Correo electrónico:</label>
                </div>
                <div class="col-75">
                    <input type="email" id="correo" name="correo" value="<?php echo isset($_POST['correo']) ? $_POST['correo'] : '';?>" required>
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                    <label for="nit">NIT:</label>
                </div>
                <div class="col-75">
                    <input type="number" id="nit" name="nit" value="<?php echo isset($_POST['nit']) ? $_POST['nit'] : '';?>" required>
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                    <label for="telefono">Telefono:</label>
                </div>
                <div class="col-75">
                    <input type="tel" id="telefono" name="telefono" value="<?php echo isset($_POST['telefono']) ? $_POST['telefono'] : '';?>" required>
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                    <label for="direccion">Direccion:</label>
                </div>
                <div class="col-75">
                    <input type="text" id="direccion" name="direccion" value="<?php echo isset($_POST['direccion']) ? $_POST['direccion'] : '';?>" required>
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                    <label for="rubro">Rubro:</label>
                </div>
                <div class="col-75">
                    <input list="rubro" name="rubro" style="width: 100%;padding: 12px;border-radius: 10px;" placeholder="Elija el rubro de su empresa" required>
                <?php
                    
                    $estadoConexion = $conn->getConn();
                    $rubros = "SELECT * FROM rubros";
                    $queryRubros=$estadoConexion->query($rubros);
                    
                    echo "<datalist id='rubro'>";
                    while($listaRubros=$queryRubros->fetch_array(MYSQLI_BOTH)){
                        $rubroActualNombre = $listaRubros['nombre_rubro'];
                        $idRubroActual = $listaRubros['id_rubro'];
                        echo "<option label='".$rubroActualNombre."' value=".$idRubroActual.">".$rubroActualNombre;
                    }
                    echo '</datalist>';
                ?>
            </select>

                   
                    <!--<input type="text" id="rubro" name="rubro" value="<?php //echo isset($_POST['rubro']) ? $_POST['rubro'] : '';?>" required>-->
                </div>
            </div>

            <?php
                include_once("../controladores/registroEmpresa.php");
            ?>

            <div class="row">
                <div class="col-50">
                    <input type="submit" value="REGISTRAR">
                </div>
                <div class="col-50">
                    <input type="button" id="boton-cancelar" onClick="window.parent.location='../ruta/rutas.php?ruta=mostrar&con=cotizando'" value="CANCELAR">
                </div>
            </div>

        </form>   
    </div>
    <?php
        include_once("../vista/layouts/footer.php");
    ?>

</body>
</html>