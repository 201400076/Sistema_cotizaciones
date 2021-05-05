<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php 

$db_host = "localhost";
$db_nombre = "sistema_de_cotizaciones";
$db_usuario = "root";
$db_contra = "";

$conexion = mysqli_connect($db_host, $db_usuario, $db_contra, $db_nombre);

        $usuario = $_GET["usuario"];
        $rol = $_GET["rol"];

        //require(datos_conexion.php);
        //$conexion = mysqli_connect($db_host, $db_usuario, $db_contra);
        if(mysqli_connect_errno()){
            echo "Fallo al conectar con la bd";
            exit();
        }
        mysqli_select_db($conexion, $db_nombre) or die ("No se encuentra la db");
        mysqli_set_charset($conexion, "utf8");
        $consulta = "INSERT INTO usuarioconrol (usuario, rolAsignado) VALUES ('$usuario', '$rol')";
        

        $verificar_usuario = mysqli_query($conexion, "SELECT * FROM usuarioconrol WHERE usuario = '$usuario'");
        if(mysqli_num_rows($verificar_usuario) > 0){
            echo '
                <script>
                    alert("Este Usuario ya tiene Rol Asignado");
                    window.location = "./asignarRoles";
                </script>
            ';
            exit();
        }

        $resultados = mysqli_query($conexion, $consulta);
        if($resultados == false){
            echo "Error en la insercion";
        }else{
            echo '
                <script>
                    alert("Se Asigno Rol Exitosamente!!!");
                    window.location = "./asignarRoles";
                </script>
            ';
        }

        mysqli_close($conexion); 

    ?>
    
</body>
</html>