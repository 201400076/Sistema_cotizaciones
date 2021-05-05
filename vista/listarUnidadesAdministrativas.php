<?php
$active = "";
include_once("layouts/navegacion.php");

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
        <h2 class="text-center font-weight-lights">Lista Unidades Administrativas</h2></h2>
            <div class=" ">
                <h1></h1>
                <hr>
                <?php
                if (isset($estado) && $estado > 2) {
                    if ($estado) {
                        echo ' <div class="alert alert-success" role="alert">
                        Se <a href="#" class="alert-link">elimino</a> exitosamente!!!!!.
                        </div>';

                    } else {
                        echo '<div class="alert alert-danger" role="alert">
                        Unidad administrativa <a href="#" class="alert-link">No se elimino</a> correctamente!!!!.
                        </div>';
                    }
                    $estado = 2;
                }

                ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Nro</th>
                            <th scope="col">Facultad</th>
                            <th scope="col">Unidad Administrativa</th>
                            <th scope="col">Monto tope</th>
                            <th scope="col">Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($unidades as $unidad) {
                        ?>
                            <tr>
                                <th scope="row"><?php echo $unidad['id_unidad'] ?></th>
                                <td><?php echo $unidad['id_facultad'] ?></td>
                                <td><?php echo $unidad['nombre_unidad'] ?></td>
                                <td><?php echo $unidad['monto_tope'] ?></td>
                                <td>
                                    <a class="btn btn-info" href="../ruta/ruta.php?ruta=editar&md=unidad&id=<?php echo $unidad['id_unidad'] ?>"> Asignar monto tope </a>
                                    <!--<a class="btn btn-danger" href="../ruta/ruta.php?ruta=eliminar&md=unidad&id=<?php echo $unidad['id_unidad'] ?>"> Eliminar</a>-->
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