
<?php
    include_once '../modelo/conexionPablo.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();
    //$consulta = "SELECT u.id_usuarios, u.nombres, u.apellidos, u.usuario, r.nombreRol FROM roles r INNER JOIN usuarios u ON r.id_usuario = u.id_usuarios";

    //$query = "SELECT id_unidad, nombre_unidad FROM unidad_administrativa";
    //$resultado = mysqli_query($query);

    $consulta = "SELECT * FROM unidad_administrativa";
    //$consulta = "SELECT id, nombre, pais, edad FROM personas ORDER BY id DESC LIMIT 1";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
    //var_dump($data);


    $consultaRol = "SELECT * FROM roles ORDER BY nombre_rol ASC";
    $resultadoRol = $conexion->prepare($consultaRol);
    $resultadoRol->execute();
    $dataRol=$resultadoRol->fetchAll(PDO::FETCH_ASSOC);

    $consultaUser = "SELECT * FROM usuarios ORDER BY nombres ASC";
    $resultadoUser = $conexion->prepare($consultaUser);
    $resultadoUser->execute();
    $dataUser=$resultadoUser->fetchAll(PDO::FETCH_ASSOC);

    $consultaUadmin = "SELECT * FROM unidad_administrativa ORDER BY nombre_unidad ASC";
    $resultadoUadmin = $conexion->prepare($consultaUadmin);
    $resultadoUadmin->execute();
    $dataUadmin=$resultadoUadmin->fetchAll(PDO::FETCH_ASSOC);


    $consultaUgasto = "SELECT * FROM unidad_gasto ORDER BY nombre_gasto ASC";
    $resultadoUgasto = $conexion->prepare($consultaUgasto);
    $resultadoUgasto->execute();
    $dataUgasto=$resultadoUgasto->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->

    <title>Panel de control - Cotizador Web</title>


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    
    <!--<link rel="stylesheet" type="text/css" href="css/index.css"> -->

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">


    <script language="javascript" src="../librerias/jquery/jquery-3.1.1.min.js"></script>
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>-->
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
    <link rel="stylesheet" href="./css/reasignar.css">


    <script language="javascript">
			$(document).ready(function(){
				$("#tipoUser").change(function () {
					
					//$('#cbx_localidad').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');
					
					$("#tipoUser option:selected").each(function () {
						id_rol = $(this).val();
						$.post("getUnidad.php", { id_estado: id_rol }, function(data){
							$("#rolUnidad").html(data);
						});            
					});
				})
			});
		</script>


</head>



<body class="fix-header card-no-border">


<?php 
    $user = $_GET["user"];
?>

    <div class="preloader" style="display: none;">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"></circle>
        </svg>
    </div>

    <div id="main-wrapper">

        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">

                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">
                        <!-- Logo icon -->
                        <b>
                            <!-- Light Logo icon -->
                            <img src="../recursos/imagenes/icono.jpg" alt="homepage" class="light-logo" style="width:34px">
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span style="">

                            <!-- Light Logo text -->
                            <span class="text-white" style=""><b> Sistema de Cotizaciones </b></span>

                        </span>
                    </a>
                </div><a class="navbar-brand" href="index.php">

                </a>
                <div class="navbar-collapse"><a class="navbar-brand" href="index.php">

                    </a>
                    <ul class="navbar-nav mr-auto mt-md-0 "><a class="navbar-brand" href="index.php">
                            <!-- This is  -->
                        </a>
                        <li class="nav-item"><a class="navbar-brand" href="index.php"> </a><a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="fa fa-bars"></i></a> </li>
                        <li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="icon-arrow-left-circle"></i></a> </li>



                    </ul>

                    <ul class="navbar-nav my-lg-0">
                    </ul>
                </div>
            </nav>
        </header> 

        <aside class="left-sidebar" method="get">

            <div class="scroll-sidebar">

                <nav class="sidebar-nav active">
                    <ul id="sidebarnav" class="in">
                        <li class="">
                            <a class="has-arrow  " href="#" aria-expanded="false"><i class="mdi mdi-barcode"></i><span class="hide-menu">Home</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="../ruta/ruta.php" id="nueva" name="nueva">Home</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>

            </div>

        </aside>


        <div class="page-wrapper" style="min-height: 600px;">

            <div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <section class="container">
                <h2><span class="glyphicon glyphicon-edit"></span>Asignar Rol</h2>
                
                <form name="form1" method="get" action="guardaRol.php">
                    <label for="usuario">Usuario: </label>

                    <select name="user" id="user">
                        <option value="0">Seleccione Usuario</option>
                        <?php foreach($dataUser as $d1) { ?>
                        
                        <option value="<?php echo $d1['id_usuarios']; ?>"><?php echo $d1 ['nombres']; ?> <?php echo $d1 ['apellidos']; ?></option>

                        <?php } ?>
                    </select>
                    

                    <label for="rolUser">Tipo de Usuario: </label>

                    <select name="rolUser" id="rolUser">
                        <option value="0">Seleccione Rol</option>
                        <?php foreach($dataRol as $d1) { ?>
                        
                        <option value="<?php echo $d1['id_rol']; ?>"><?php echo $d1 ['nombre_rol']; ?></option>

                        <?php } ?>
                    </select>

                    
                    <label for="rol">Unidad Administrativa</label>
                    
                    <select name="uadmin" id="uadmin">
                        <option value="0">Seleccionar Unidad Administrativa</option>
                        <?php foreach($dataUadmin as $d1) { ?>
                        
                        <option value="<?php echo $d1['id_unidad']; ?>"><?php echo $d1 ['nombre_unidad']; ?></option>

                        <?php } ?>

                    </select>

                    <label for="tipoUsuario">Unidad de Gasto</label>

                    <select name="tipoUser" id="tipoUser">
                        <option value="0">Seleccionar Unidad de Gasto</option>
                        <?php foreach($dataUgasto as $d1) { ?>
                        
                            <option value="<?php echo $d1['id_gasto']; ?>"><?php echo $d1 ['nombre_gasto']; ?></option>

                        <?php } ?>
                    </select>

                    <input type="submit" value="Asignar Rol" class="btn_save">
                </form>
            </section>
        </div>
    </div>
</div>

            <footer class="footer">
                © Sitio web desarrollado y gestionado por la grupo empresa <a target="_blank">PF S.R.L</a>
                    <div class="text-center">
                        contactos:(+591) 76436540 – 44355215
                    </div>
            </footer>
        </div>

    </div>

    <script src="../js/jquery.min.js"></script>

    <!--Menu sidebar -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sticky-kit/1.1.3/sticky-kit.min.js"></script>
    <script src="../js/custom.min.js"></script>


</body>
</html>
