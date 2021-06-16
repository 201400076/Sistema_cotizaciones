<?php
$active = "active";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Formulario Registro de Usuario</title>
    <link href="../librerias/css/blue.css" id="theme" rel="stylesheet">
    <link href="../librerias/css/styles.css" rel="stylesheet">
    <link rel="icon" href="assets/images/cart_icon2.png">
    <link rel="stylesheet" href="../librerias/css/bootstrap.min.css">
    
	<meta charset="utf-8"/>
	<meta name="description"/>
    <link rel="stylesheet" type="text/css" href="../vista/css/estiloFRU.css" media="screen" />
    <script src="../librerias/jquery/jquery-3.3.1.min.js"></script>
</head>
<body class="fix-header card-no-border">
   
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
                        <li class="nav-item"><a class="navbar-brand" href="index.php"> </a><a
                                class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark"
                                href="javascript:void(0)"><i class="fa fa-bars"></i></a> </li>
                        <li class="nav-item"> <a
                                class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark"
                                href="javascript:void(0)"><i class="icon-arrow-left-circle"></i></a> </li>



                    </ul>

                    <ul class="navbar-nav my-lg-0">

                        <!-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="#"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                    class="fa fa-user"></i> Usuario</a>
                            <div class="dropdown-menu dropdown-menu-right animated flipInY">
                                <ul class="dropdown-user">
                                    <li>
                                        <div class="dw-user-box">
                                            <div class="u-img"><img src="" alt="user">
                                            </div>
                                            <div class="u-text">
                                                <h4>Nombre Usuario</h4>
                                                <p class="text-muted">info@usuario.com</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="usuarios.php?profile=1"><i class="ti-user"></i> Mi Perfil</a></li>
                                    <li><a href="cotizaciones.php?type=1"><i class="ti-wallet"></i> Mis cotizaciones</a>
                                    </li>

                                    <li role="separator" class="divider"></li>

                                    <li><a href="login.php?logout"><i class="fa fa-power-off"></i> Cerrar sesión</a>
                                    </li>
                                </ul>
                            </div>
                        </li> -->

                    </ul>
                </div>
            </nav>
        </header> <!-- ============================================================== -->

        <aside class="left-sidebar" method="get">
        
            <div class="scroll-sidebar">
             
                <nav class="sidebar-nav active">
                    <ul id="sidebarnav" class="in">
                      <!--   <li class="nav-small-cap">PERSONAL</li>
                        <li class="active" id="inicio">
                            <a class="has-arrow active" href="homkke.php" aria-expanded="false"><i
                                    class="mdi mdi-gauge"></i><span class="hide-menu">Inicio </span></a>

                        </li>
                        <li>
                            <a class="has-arrow " href="cotizaciones.php" aria-expanded="false"><i
                                    class="mdi mdi-shopping"></i><span class="hide-menu">Cotizaciones</span></a>

                        </li>

                        <li>
                            <a class="has-arrow " href="clientes.php" aria-expanded="false"><i
                                    class="mdi mdi-contact-mail"></i><span class="hide-menu">Clientes</span></a>

                        </li> -->
                        <li class="<?php echo $active?>">
                            <a class="has-arrow <?php echo $active?> " href="#" aria-expanded="false"><i class="mdi mdi-barcode"></i><span
                                    class="hide-menu">Home</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li ><a href="../ruta/ruta.php" id="nueva" name="nueva">Home</a></li>
                            </ul>
                        </li>
                        <li class="<?php echo $active?>">
                            <a class="has-arrow <?php echo $active?> " href="#" aria-expanded="false"><i class="mdi mdi-barcode"></i><span
                                    class="hide-menu">Solicitudes</span></a>
                            <ul aria-expanded="false" class="collapse">
<!-- <<<<<<< HEAD -->
                                <li ><a href="../ruta/rutas.php?ruta=mostrar&con=nueva" id="nueva" name="nueva">Solicitudes Pendientes</a></li>
                                <li><a href="../ruta/rutas.php?ruta=mostrar&con=aceptada">Solicitudes Aceptadas</a></li>
								<li><a href="../ruta/rutas.php?ruta=mostrar&con=rechazada">Solicitudes Rechazadas</a></li>
                                
<!-- ======= -->
                                 <!-- <li ><a href="../vista/formularioRU.php" id="nueva" name="nueva">usuario</a></li>  -->
                                <!-- <li><a href="../ruta/rutas.php?ruta=mostrar&con=aceptada">Solicitudes Aceptadas</a></li>
								<li><a href="../ruta/rutas.php?ruta=mostrar&con=rechazada">Solicitudes Rechazadas</a></li> -->
<!-- >>>>>>> 7af3d9df64eeef8eeb31cbb131604d9d55fe7036 -->

                            </ul>
                        </li>

                   
<!-- 
                        <li>
                            <a class="has-arrow " href="#" aria-expanded="false"><i
                                    class="mdi mdi-account-settings-variant"></i><span class="hide-menu">Administrar
                                    accesos</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="usuarios.php">Usuarios</a></li>
                                <li><a href="group_list.php">Roles de usuario</a></li>

                            </ul>
                        </li> -->

                     <!--    <li>
                            <a class="has-arrow " href="#" aria-expanded="false"><i class="mdi mdi-settings"></i><span
                                    class="hide-menu">Configuración</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="empresa.php">Perfil de la empresa</a></li>
                                <li><a href="monedas.php">Monedas</a></li>
                                <li><a href="impuestos.php">Impuestos</a></li>
                                <li><a href="plantillas.php">Plantillas</a></li>
                            </ul>
                        </li> -->
                    </ul>
                </nav>
                
            </div>
         
        </aside>
    
    
        <div class="page-wrapper" style="min-height: 600px;"> <!-- 352 -->
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
                    <label for="password">Password:</label>
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
