<?php 
    $db_host = "localhost";
    $db_nombre = "sistema_de_cotizaciones";
    $db_usuario = "root";
    $db_contra = "";

    $conexion = mysqli_connect($db_host, $db_usuario, $db_contra, $db_nombre);

    $usuario = $_GET["user"];
    $rol = $_GET["rolUser"];
    $uadmin = $_GET["uadmin"];
    $ugasto = $_GET["ugasto"];

    if(mysqli_connect_errno()){
        echo "Fallo al conectar con la bd";
        exit();
    }
    mysqli_select_db($conexion, $db_nombre) or die ("No se encuentra la db");
    mysqli_set_charset($conexion, "utf8");

    // if($usuario != "" or $rol == 0){
    //     if($rol == 200){
    //         $consultaInsertar = "INSERT INTO `usuarioconrol` (`id_usuarios`, `id_rol`, `id_gasto`) VALUES ('$usuario', '$rol', '$ugasto')";
    //     }
    //     if($rol == 100){
    //         $consultaInsertar = "INSERT INTO `usuarioconrol` (`id_usuarios`, `id_rol`, `id_unidad`) VALUES ('$usuario', '$rol', '$uadmin')";
    //     }
    // }else{
    //     echo '
    //         <script>
    //             alert("Seleccione un Rol Por Favor");
    //             window.location = "./rolesAsignadosprueba.php";
    //         </script>
    //         ';
    // }


    
    if($rol == 200){
             //verificar que unidades no se repitan en la base de datos

     $consultaugasto = "SELECT * FROM `usuarioconrol` WHERE `id_gasto` = '$ugasto'";
     $verificar_ugasto = mysqli_query($conexion, $consultaugasto);
     if(mysqli_num_rows($verificar_ugasto) > 0){
         echo '
             <script>
                 alert("Esta Unidad de gasto ya esta registrado");
                 window.location = "./rolesAsignadosprueba.php";
             </script>
             ';
             exit();
     }

        $consultaInsertar = "INSERT INTO `usuarioconrol` (`id_usuarios`, `id_rol`, `id_gasto`) VALUES ('$usuario', '$rol', '$ugasto')";
    }else if($rol == 100){

        //verificar que unidades no se repitan en la base de datos
    $consultauadmin = "SELECT * FROM `usuarioconrol` WHERE `id_unidad` = '$uadmin'";
    $verificar_uadmin = mysqli_query($conexion, $consultauadmin);
    if(mysqli_num_rows($verificar_uadmin) > 0){
        echo '
            <script>
                alert("Esta Unidad administrativa ya esta registrado");
                window.location = "./rolesAsignadosprueba.php";
            </script>
            ';
            exit();
    }

        $consultaInsertar = "INSERT INTO `usuarioconrol` (`id_usuarios`, `id_rol`, `id_unidad`) VALUES ('$usuario', '$rol', '$uadmin')";
    }else if($rol == 0){
        echo '
            <script>
                alert("Seleccione un Rol Por Favor");
                window.location = "./rolesAsignadosprueba.php";
            </script>
            ';
    }

    // //verificar que unidades no se repitan en la base de datos
    // $consultauadmin = "SELECT * FROM `usuarioconrol` WHERE `id_unidad` = '$uadmin'";
    // $verificar_uadmin = mysqli_query($conexion, $consultauadmin);
    // if(mysqli_num_rows($verificar_uadmin) > 0){
    //     echo '
    //         <script>
    //             alert("Esta Unidad administrativa ya esta registrado");
    //             window.location = "./rolesAsignadosprueba.php";
    //         </script>
    //         ';
    //         exit();
    // }

    
    //  //verificar que unidades no se repitan en la base de datos

    //  $consultaugasto = "SELECT * FROM `usuarioconrol` WHERE `id_gasto` = '$ugasto'";
    //  $verificar_ugasto = mysqli_query($conexion, $consultaugasto);
    //  if(mysqli_num_rows($verificar_ugasto) > 0){
    //      echo '
    //          <script>
    //              alert("Esta Unidad de gasto ya esta registrado");
    //              window.location = "./rolesAsignadosprueba.php";
    //          </script>
    //          ';
    //          exit();
    //  }


    $resultados = mysqli_query($conexion, $consultaInsertar);
    if($resultados == false){
        echo "Error en la insercion";
    }else{
        echo '
            <script>
                alert("Se Asigno Rol Exitosamente!!!");
                window.location = "./rolesAsignadosprueba.php";
            </script>
        ';
    }

    mysqli_close($conexion); 
?>