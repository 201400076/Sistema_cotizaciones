<!DOCTYPE html>
<html>
<head>
	<title>Formulario Registro de Usuario</title>
	<meta charset="utf-8"/>
	<meta name="description"/>
    <link rel="stylesheet" type="text/css" href="../vista/css/estiloFRU.css" media="screen" />
    <script src="../librerias/jquery/jquery-3.3.1.min.js"></script>
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
                    <input type="text" id="usuario" name="usuario" placeholder="Usuario">
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                    <label for="password">Contraseña:</label>
                </div>
                <div class="col-75">
                    <input type="password" id="password" name="password" placeholder="Password" >
                </div>
            </div>         
            <div class="row">
                <div class="col-50">
                <button type="button" id="ingresar" class="btn btn-dark text-center btn-block mt-2 mb-2 ingresar" data-toggle="modalJust">Ingresar</button>
                </div>                
            </div>
        </form>   
    </div>
    <script src="../controladores/controladorIngreso.js"></script>
</body>
</html>
