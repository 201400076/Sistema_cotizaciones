
<?php
    session_start();
    $id_pendientes=$_SESSION['usuario'];
    $id_unidad=$_SESSION["unidad"];
    include_once '../modelo/conexionPablo.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();
    
    $consulta="SELECT * FROM pedido p WHERE p.id_usuarios='$id_pendientes' and p.id_gasto='$id_unidad'";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

    $consulta="SELECT nombres,apellidos FROM usuarios WHERE usuarios.id_usuarios='$id_pendientes'";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data2=$resultado->fetchAll(PDO::FETCH_ASSOC);
    $nombre=$data2['0']['apellidos']." ".$data2['0']['nombres'];
    

    $realizadas=15;
    $rechazadas=6;
    $cotizadas=0;
    $realizadas=9;
    include('layouts/navGasto.php')
    
?>
<h2 class="card-title" style="text-align: center;"><strong>INFORME DE SOLICITUDES DE PEDIDO</strong></h2>
 <div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaPersonas" class="table table-striped table-bordered table-condensed" style="width:100%">                      
                        <tbody class="text-center">
                            
                            <tr>
                                <td>SOLICITUDES DE PEDIDO REALIZADAS</td>
                                <td><?php echo $realizadas?></td>
                            </tr>        
                            <tr>
                                <td>SOLICITUDES DE PEDIDO RECHAZADAS</td>
                                <td><?php echo $rechazadas?></td>
                            </tr>
                            <tr>
                                <td>SOLICITUDES DE PEDIDO COTIZADAS</td>
                                <td><?php echo $cotizadas?></td>
                            </tr>
                            <tr>
                                <td>SOLICITUDES DE PEDIDO REALIZADAS</td>
                                <td><?php echo $realizadas?></td>
                            </tr>
                        </tbody>        
                       </table>                    
                    </div>
                </div>
        </div>  
    </div>    
    <script type="text/javascript" src="../controladores/controladorInfo.js"></script>  
    </body>
</html>
