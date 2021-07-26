<?php
    include_once '../modelo/conexionPablo.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();


    $consultaUser = "SELECT * FROM usuarios ORDER BY nombres ASC";
    $resultadoUser = $conexion->prepare($consultaUser);
    $resultadoUser->execute();
    $dataUser=$resultadoUser->fetchAll(PDO::FETCH_ASSOC);


    $consultaRol = "SELECT * FROM roles ORDER BY nombre_rol ASC";
    $resultadoRol = $conexion->prepare($consultaRol);
    $resultadoRol->execute();
    $dataRol=$resultadoRol->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Formulario Registro de Usuario</title>
	<meta charset="utf-8"/>
	<meta name="description"/>
    <link rel="stylesheet" type="text/css" href="../vista/css/estiloFRU.css" media="screen" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <!--<link rel="stylesheet" href="../css/estilosRol.css"> -->

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

        #uad, #uadmin, #ugasto, #uga {
            visibility: hidden;
        }
	</style>

        <script src="../librerias/jquery/jquery-3.6.0.js"></script>

        <script>
            $(document).ready(function(){
                
                $("#selec1").click(function(){
                    $("#uad").css("visibility", "hidden", );
                    $("#uadmin").css("visibility", "hidden");

                    $("#uga").css("visibility", "hidden");
                    $("#ugasto").css("visibility", "hidden");
                });

                $("#selec2").click(function(){
                    $("#uad").css("visibility", "visible");
                    $("#uadmin").css("visibility", "visible");

                    $("#uga").css("visibility", "hidden");
                    $("#ugasto").css("visibility", "hidden");
                });

                $("#selec3").click(function(){
                    $("#uad").css("visibility", "visible");
                    $("#uadmin").css("visibility", "visible");

                    $("#uga").css("visibility", "visible");
                    $("#ugasto").css("visibility", "visible");
                });

            });

        </script>

        <!-- <script>
            function validar(){
                var seleccioncbxs = document.getElementById('user');
                if(seleccioncbxs.value == 0 || seleccioncbxs. value == ""){
                    alert("Seleccione un usuario")
                }
                
            }
        </script> -->


</head>
<body>
<?php
    $active = "active";
    include_once("../vista/layouts/navegacion.php");
?>

    <div class="container" style="width: 650px;margin-top: 0;">
        
        <h2>Asignar Rol</h2>
        
        <form name="form1" method="get" action="insertarRol.php">

            <div class="row">
                <div class="col-25">
                    <label for="nombres">Usuario:</label>
                </div>
                <div class="col-75">
                    <select name="user" id="user" required>
                        <option value="0">Seleccione Usuario</option>

                        <?php foreach($dataUser as $d1) { ?>
                        
                        <option value="<?php echo $d1['id_usuarios']; ?>"><?php echo $d1 ['nombres']; ?> <?php echo $d1 ['apellidos']; ?></option>

                        <?php } ?>                       
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                    <label for="apellidos">Tipo de Usuario:</label>
                </div>
                <div class="col-75">
                    <select name="rolUser" id="rolUser">
                        <option value="0" id="selec1">Ninguno</option>
                        <option value="Unidad Administrativa" id="selec2">Usuario de Unidad Administrativa</option>
                        <option value="Unidad de Gasto" id="selec3">Administrador de Unidad de Gasto</option>
                    </select>                   
                </div>
            </div>

            <div class="row" id="Unidad Administrativa">
                <div class="col-25">
                    <label for="correo" id="uad">Unidad Admin:</label>
                </div>
                <div class="col-75">
                    <select name="uadmin" id="uadmin">
                        <option value="0">Seleccionar Unidad Administrativa</option>
                    </select>
                </div>
            </div>
            
            <div class="row" id="Unidad de Gasto">
                <div class="col-25">
                    <label for="usuario" id="uga">Unidad de Gasto:</label>
                </div>
                <div class="col-75">
                    <select name="ugasto" id="ugasto">
                        <option value="0">Elige Unidad de Gasto</option>   
                    </select>               
                </div>
            </div>

            <?php
                include_once("../controladores/registroUsuario.php");
            ?>

            <div class="row">
                <div class="col-50">
                    <input type="submit" onclick="validar();" value="ASIGNAR ROL" class="btn_save">
                </div>
                <div class="col-50">
                    <input type="button" id="boton-cancelar" onClick="window.parent.location='../vista/home.php'" value="CANCELAR">
                </div>
                
            </div>

        </form>   
    </div>
    <?php
        include_once("../vista/layouts/footer.php");
    ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript" src="../js/rol.js"></script>
<!--<script type="text/javascript" src="../js/despliegueRol.js"></script>-->
</body>
</html>