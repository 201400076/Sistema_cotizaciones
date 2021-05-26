<?php
$db_host = "localhost";
$db_nombre = "sistema_de_cotizaciones";
$db_usuario = "root";
$db_contra = "";

$conexion = mysqli_connect($db_host, $db_usuario, $db_contra, $db_nombre);
//$consulta = "SELECT u.id_usuarios, u.nombres, u.apellidos, u.usuario, r.nombreRol FROM roles r INNER JOIN usuarios u ON r.id_usuario = u.id_usuarios";
$consulta = "SELECT u.id_usuarios, u.nombres, u.apellidos, u.usuario FROM usuarios u";

$consulta1 = "SELECT r.usuario, r.rolAsignado FROM usuarioconrol r";
?>

<html lang="en"><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->

    <title>Panel de control - Cotizador Web</title>
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
    <link rel="stylesheet" href="./css/estiloRol.css">

</head>



<body class="fix-header card-no-border">

<?php
    $active = "active";
    include_once("../vista/layouts/navegacion.php");
?>

    <div class="preloader" style="display: none;">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"></circle>
        </svg>
    </div>

    <div id="main-wrapper">
        <div class="page-wrapper" style="min-height: 600px;"> <!-- 352 -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <!--  desde aqui el contenido ferrrrrrrrrrrr-->

            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <section class="container">
                            <h2><span class="glyphicon glyphicon-edit"></span> Lista de Usuarios</h2>
                            <table>
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Usuario</th>
                                    <th>Acciones</th>
                                </tr>
                                <?php
                                    $query = mysqli_query($conexion, $consulta);
                                    $result = mysqli_num_rows($query);
                                    if ($result > 0) {
                                        while ($data = mysqli_fetch_array($query)) {
                                    ?>
                                            <tr>
                                                <td><?php echo $data["id_usuarios"] ?></td>
                                                <td><?php echo $data["nombres"] ?></td>
                                                <td><?php echo $data["apellidos"] ?></td>
                                                <td><?php echo $data["usuario"] ?></td>
                                                <td>
                                                    <a class="link_asignar" href="reasignar.php?user=<?php echo $data["usuario"] ?>">Asignar Rol</a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                ?>

                            </table>
                        </section>

                        <section class="container">
                            <h2><span class="glyphicon glyphicon-edit"></span> Lista Usuarios Con Rol</h2>
                            <table>
                                <tr>
                                    <th>Usuario</th>
                                    <th>Rol</th>
                                </tr>

                                <?php 
                                    $query1 = mysqli_query($conexion, $consulta1);
                                    $result1 = mysqli_num_rows($query1);
                                    if($result1 > 0){
                                        while ($data1 = mysqli_fetch_array($query1)){
                                    ?>

                                            <tr>
                                                <td><?php echo $data1["usuario"] ?></td>
                                                <td><?php echo $data1["rolAsignado"] ?></td>
                                            </tr>
                                        <?php
                                        }
                                    } 
                                ?>
                                    <tr>
                        
                                    </tr>
                            </table>
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
