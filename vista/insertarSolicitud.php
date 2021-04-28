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
    include('../modelo/conexionPablo.php');
    $idPedido=1;
    $archivo="ruta.pdf";
        if($_FILES['archivo']['error']){
            switch($_FILES['archivo']['error']){
                case 1:
                    echo "el tama;o es muy grande";
                    break;
                case 2:
                    echo "el tama;o del archivo pasa los 2 mb";
                    break;
            } 
        }else{
            echo "subida correctamente" . "<br>";
            if((isset($_FILES["archivo"]["name"]) && ($_FILES["archivo"]["error"]==UPLOAD_ERR_OK))){            
                $destino="archivos/";
                echo $_FILES['archivo']['tmp_name'];
                move_uploaded_file($_FILES['archivo']['tmp_name'],$destino . $_FILES['archivo']['name']);
                $archivo=$destino . $_FILES['archivo']['name'];
                echo "el archivo" . $_FILES['archivo']['name'] . "se guardo<br>";       
                     
            }else{
                echo "no se puedo copiar el archivo";
            }
            
        }
        $idItem="12";
        $cantidad=$_POST["cantidad"];
        $unidad=$_POST["unidad"];
        $detalle=$_POST["detalle"];
        $archivo=$_FILES["archivo"]["name"];
        $sql = "INSERT INTO items(id_pedido,cantidad,unidad,detalle,archivo) VALUES (:idPedido,:cantidad,:unidad,:detalle,:archivo)";
        $resultado=$conexion->prepare($sql);
        $resultado->execute(array(":idPedido"=>$idPedido, ":cantidad"=>$cantidad,":unidad"=>$unidad,":detalle"=>$detalle,":archivo"=>$archivo));        
        header("Location:solicitudes.php");
    ?>
</body>
</html>