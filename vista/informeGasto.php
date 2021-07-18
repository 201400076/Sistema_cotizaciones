
<?php
    session_start();
    $id_pendientes=$_SESSION['usuario'];
    $id_unidad=$_SESSION["unidad"];
    include_once '../modelo/conexionPablo.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    $consulta="SELECT nombres,apellidos FROM usuarios WHERE usuarios.id_usuarios='$id_pendientes'";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data2=$resultado->fetchAll(PDO::FETCH_ASSOC);
    $nombre=$data2['0']['apellidos']." ".$data2['0']['nombres'];
    
    
    $consulta="SELECT * FROM pedido p WHERE p.id_usuarios='$id_pendientes' and p.id_gasto='$id_unidad'";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);


?>
<?php
    include('layouts/navGasto.php')
?>
<h2 class="card-title" style="text-align: center;"><strong>SOLICITUDES DE PEDIDO</strong></h2>
 <div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaPersonas" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>ID</th>
                                <th>FECHA</th>
                                <th>JUSTIFICACION</th>                                
                                <th>ACCION</th>  
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {                                                        
                            ?>                            
                            <tr>
                                <td><?php echo $dat['id_pedido'] ?></td>
                                <td><?php echo $dat['fecha'] ?></td>
                                <td><?php echo $dat['justificacion'] ?></td>
                                <td>
                                    <button type="button" id="info" class=" info btn btn-info"><a style="color:white" href="infoPedido.php?es=<?php echo $dat['id_pedido'] ?>">Detalle</a></button>
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
    <script type="text/javascript" src="../controladores/controladorInfo.js"></script>  
    </body>
</html>
