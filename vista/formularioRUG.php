
<!DOCTYPE html>
<html>
<head>
	<title>Formulario Registro de Usuario Unidad Gasto</title>
	<meta charset="utf-8"/>
	<meta name="description"/>
    <link rel="stylesheet" type="text/css" href="../css/estiloFRU.css" media="screen" />
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

    <div class="container">
        
        <h2>Formulario de Registro de Usuario de Unidad Gasto</h2>
        
        <form action="../controladores/registroUG.php" method="POST">
            <div class="row">
                <div class="col-25">
                    <label for="nombres">Nombre(s):</label>
                </div>
                <div class="col-75">
                    <input type="text" id="nombres" name="nombres" placeholder="" required>
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                    <label for="apellidos">Apellido(s):</label>
                </div>
                <div class="col-75">
                    <input type="text" id="apellidos" name="apellidos" placeholder="" required>
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                    <label for="correo">Correo electrónico:</label>
                </div>
                <div class="col-75">
                    <input type="email" id="correo" name="correo" placeholder="" required>
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                    <label for="unidad_administrativa">Unidad Administrativa:</label>
                </div>
                <div class="col-75">
                    <select class="seleccion" id="unidad_administrativa" name="unidad_administrativa" required>
                        <option selected hidden value="">Unidades Administrativas</option>
                        <option class="seleccion" value="unidad administrativa 1">Unidad Administrativa 1</option>
                        <option class="seleccion" value="unidad administrativa 2">Unidad Administrativa 2</option>
                        <option class="seleccion" value="unidad administrativa 3">Unidad Administrativa 3</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                    <label for="unidad_gasto">Unidad de Gasto:</label>
                </div>
                <div class="col-75">
                    <select class="seleccion" id="unidad_gasto" name="unidad_gasto">
                        <option selected hidden value="">Unidades de Gasto</option>
                        <option class="seleccion" value="unidad de gasto 1">Unidad de gasto 1</option>
                        <option class="seleccion" value="unidad de gasto 2">Unidad de gasto 2</option>
                        <option class="seleccion" value="unidad de gasto 3">Unidad de gasto 3</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                    <label for="rol">Rol:</label>
                </div>
                <div class="col-75">
                    <select id="rol" name="rol" required>
                        <option selected hidden value="">Roles</option>
                        <option value="Rol 1">Rol 1</option>
                        <option value="Rol 2">Rol 2</option>
                        <option value="Rol 3">Rol 3</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                    <label for="usuario">Usuario:</label>
                </div>
                <div class="col-75">
                    <input type="text" id="usuario" name="usuario" placeholder="" required>
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                    <label for="password">Contraseña:</label>
                </div>
                <div class="col-75">
                    <input type="password" id="password" name="password" placeholder="" required>
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                    <label for="password_con">Confirmar Contraseña:</label>
                </div>
                <div class="col-75">
                    <input type="password" id="password_con" name="password_con" placeholder="" required>
                </div>
            </div>

            <div class="row">
                <div class="col-50">
                    <input type="submit" value="REGISTRAR">
                </div>
                <div class="col-50">
                    <input type="button" id="boton-cancelar" onClick="window.parent.location='../index.php'" value="CANCELAR">
                </div>
            </div>

            
        </form>   
    </div>

</body>
</html>
