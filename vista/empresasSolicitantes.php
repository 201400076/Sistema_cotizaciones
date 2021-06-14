<!DOCTYPE html>
<html>
<head>
	<title>Formulario Registro de Usuario</title>
	<meta charset="utf-8"/>
	<meta name="description"/>
    <link rel="stylesheet" type="text/css" href="../vista/css/estiloFRU.css" media="screen" />

</head>
<body>
    <div class="container" style="width: 650px;margin-top: 0;">
        
        <h2>Empresa participante</h2>
        
        <form action="../controladores/ingresoSolicitante.php" method="POST">            
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
            <div class="row">
                <div class="col-50">
                <input class="btn btn-info" id="btn" type="submit">
                </div>                
            </div>
        </form>   
    </div>
</body>
</html>
