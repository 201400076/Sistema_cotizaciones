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
     $active="active";
    include_once("../vista/layouts/navegacion.php");

?>

    <div class="container" style="width: 650px;">
        
        <h2>Formulario de Registro de Usuario</h2>
        
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
            <div class="row">
                <div class="col-25">
                    <label for="nombres">Nombre(s):</label>
                </div>
                <div class="col-75">
                    <input type="text" id="nombres" name="nombres" placeholder="Nombre(s) *" required>
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                    <label for="apellidos">Apellido(s):</label>
                </div>
                <div class="col-75">
                    <input type="text" id="apellidos" name="apellidos" placeholder="Apellido(s) *" required>
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                    <label for="correo">Correo electrónico:</label>
                </div>
                <div class="col-75">
                    <input type="email" id="correo" name="correo" placeholder="ejemplo@gmail.com" required>
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                    <label for="usuario">Usuario:</label>
                </div>
                <div class="col-75">
                    <input type="text" id="usuario" name="usuario" placeholder="Al menos 6 caracteres" required>
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                    <label for="password">Contraseña:</label>
                </div>
                <div class="col-75">
                    <input type="password" id="password" name="password" placeholder="Entre 8-16, al menos(1 mayuscula,1 minuscula,1 numero)" required>
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                    <label for="password_con">Confirmar Contraseña:</label>
                </div>
                <div class="col-75">
                    <input type="password" id="password_con" name="password_con" placeholder="Repita la contrasena" required>
                </div>
            </div>

            <div class="row">
                <div class="col-50">
                    <input type="submit" value="REGISTRAR">
                </div>
                <div class="col-50">
                    <input type="button" id="boton-cancelar" onClick="window.parent.location='../vista/home.php'" value="CANCELAR">
                </div>
            </div>

            <?php
                include_once("../controladores/registroUsuario.php");
            ?>

        </form>   
    </div>
    <?php
        include_once("../vista/layouts/footer.php");
    ?>

</body>
</html>
