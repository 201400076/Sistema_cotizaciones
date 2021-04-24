<?php
$active = "";
include_once("layouts/navegacion.php");

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h2><span class="glyphicon glyphicon-edit"></span> Lista de Unidades Administrativas</h2>
            <div class="unidadAdministrativa">
                <h1></h1>
                <hr>
                <table class = "table" id="tablaItems"> 
                    <tr>
                        <th class="primeraFila">Nro</th>
                        <th class="primeraFila">Facultad</th>
                        <th class="primeraFila">Unidad Administrativa</th>
                        <th class="primeraFila">Monto tope</th>
                        <th class="primeraFila">Accion</th>
                    </tr>
                    <tbody>
                        <?php
                        foreach ($unidades as $unidad) {
                            ?> 
                            <tr>
                                <td><?php echo $unidad['id_unidad'] ?></td>
                                <td><?php echo $unidad['id_facultad'] ?></td>
                                <td><?php echo $unidad['nombre_unidad'] ?></td>
                                <td><?php echo $unidad['monto_tope'] ?></td>
                                <td>
                                    <a class = "btn btn-success" href=""> Editar</a>
                                    <a class = "btn btn-danger" href=""> Eliminar</a>
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