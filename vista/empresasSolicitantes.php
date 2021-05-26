<!DOCTYPE html>
<html>
<head>
	<title>Formulario Registro de Usuario</title>
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
<?php
    $active = "active";
    include_once("../vista/layouts/navegacionPendientes.php");
?>

    <div class="container" style="width: 650px;margin-top: 0;">
        
        <h2>Empresa participante</h2>
        
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">            
            <div class="row">
                <div class="col-25">
                    <label for="usuario">Usuario:</label>
                </div>
                <div class="col-75">
                    <input type="text" id="usuario" name="usuario" placeholder="Usuario" value="<?php echo isset($_POST['usuario']) ? $_POST['usuario'] : '';?>">
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                    <label for="password">Contraseña:</label>
                </div>
                <div class="col-75">
                    <input type="password" id="password" name="password" placeholder="Password" value="<?php echo isset($_POST['password']) ? $_POST['password'] : '';?>">
                </div>
            </div>
            <?php
                //include_once("../controladores/ingresoEmpresa.php");
            ?>

            <div class="row">
                <div class="col-50">
                <a class="btn btn-info" target="_top" href="../vista/registroCotizacion.php">Ingresar</a>                    
                </div>                
            </div>
        </form>   
    </div>
    <?php
        include_once("../vista/layouts/footer.php");
    ?>

</body>
</html>
