<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/estiloRol.css">
</head>
<body>
<?php
$active = "";
include_once("layouts/navegacion.php");

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
        <h2 class="text-center font-weight-lights">Lista Unidades de Gasto</h2></h2>
            <div class=" ">
                <h1></h1>
                <hr>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Nro</th>
                            <th scope="col">Unidad de Gasto</th>
                            <th scope="col">Unidad Administrativa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($unidadesGasto as $unidadGasto) {
                        ?>
                            <tr>
                                <th scope="row"><?php echo $unidadGasto['id_gasto'] ?></th>
                                <td><?php echo $unidadGasto['nombre_gasto'] ?></td>
                                <td><?php echo $unidadGasto['id_unidad'] ?></td>
                                <td>
                                    <!--<a class="btn btn-success" href="/ruta/ruta.php?ruta=editarUnidadGasto&md=unidad&id=<?php echo $unidadGasto['id_gasto'] ?>"> Editar </a>
                                    <a class="btn btn-danger" href="/ruta/ruta.php?ruta=eliminarUnidadGasto&md=unidad&id=<?php echo $unidadGasto['id_gasto'] ?>"> Eliminar</a>-->
                                </td>
                            </tr>
                        <?php

                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
include_once("layouts/footer.php");
?>
</body>
</html>