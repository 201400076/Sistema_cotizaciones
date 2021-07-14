
<?php
    session_start();
    $id_pendientes=$_SESSION['usuario'];
    $id_unidad=$_SESSION["unidad"];
    $id_pedido=$_GET['es'];
    include_once '../modelo/conexionPablo.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();
    
    $consulta="SELECT * FROM pedido p, items i WHERE p.id_pedido=i.id_pedido and p.id_pedido='$id_pedido'";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);


?>
<?php
    include('layouts/navGasto.php')
?>
<h2 class="card-title" style="text-align: center;"><strong>INFORME DE SOLICITUDES DE PEDIDO # <?php echo $id_pedido?></strong></h2>
<div class="container mt-4 mb-4">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaPersonas" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>id_pendientes</th>
                                <th>cantidad</th>
                                <th>unidad</th>                                
                                <th>detalle</th>  
                                <th>archivo</th>                              
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {                                                        
                            ?>                            
                            <tr>
                                <td><?php echo $dat['id_pedido'] ?></td>
                                <td><?php echo $dat['cantidad'] ?></td>
                                <td><?php echo $dat['unidad'] ?></td>
                                <td><?php echo $dat['detalle'] ?></td>                                  
                                <td><a target='_black' href="/Sistema_cotizaciones/archivos/<?php echo $dat['ruta']?>" type='button'> <?php echo $dat['archivo']?> </a>        
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
