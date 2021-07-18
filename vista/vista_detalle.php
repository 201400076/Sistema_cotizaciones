<?php
    session_start();
    require_once('layouts/navAdministracion.php');
    require_once("../modelo/solicitudes_administracion.php");        
    $id_usuario=$_GET['id_usuario'];
    $id_pedido=$_GET['id_pedido'];
    $id_solicitud=$_GET['id_solicitud'];
    
    $id_pendientes=$id_usuario;
    $consulta="SELECT id_pedido,cantidad,unidad,detalle,archivo,ruta FROM items WHERE items.id_pedido='$id_pedido'";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

    $consulta="SELECT nombres,apellidos FROM usuarios WHERE usuarios.id_usuarios='$id_pendientes'";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data2=$resultado->fetchAll(PDO::FETCH_ASSOC);
    $nombre=$data2['0']['apellidos']." ".$data2['0']['nombres'];

    $consulta="SELECT nombres,apellidos FROM usuarios WHERE usuarios.id_usuarios='$id_pendientes'";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data2=$resultado->fetchAll(PDO::FETCH_ASSOC);
    $nombre=$data2['0']['apellidos']." ".$data2['0']['nombres'];

    $consulta="SELECT fecha,justificacion FROM pedido WHERE pedido.id_pedido='$id_pedido'";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data3=$resultado->fetchAll(PDO::FETCH_ASSOC);
    $fecha=$data3['0']['fecha'];


    $fechaActual = date('Y-m-d');
    $fechaLimite = date("Y-m-d",strtotime($fechaActual."+ 1 month")); 
?>

    <section class="mt-4">
        <div class="row">
            <div class="col-lg-12">
                <h2>Solicitado por:  <?php echo $nombre?></h2>
            </div>
            <div class="col-lg-12">
                <h2>Fecha de solicitud:  <?php echo $fecha?></h2>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <button id="btnNuevo" type="button" class="btn btn-dark" data-toggle="modal">Justificacion</button>    
            </div>    
        </div>    
    </div> 

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
                                <td><a target='_black' href="/Sistema_cotizaciones/archivos/solicitudesPedido/<?php echo $dat['ruta']?>" type='button'> <?php echo $dat['archivo']?> </a>        
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


    <div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formPersonas">    
            <div class="modal-body">                       
                <div class="form-group">  
                        
                    <?php 
                    if($data3['0']['justificacion']==''){
                        echo "<p class='text-secondary'>No hay ninguna justificacion!!!</p>";
                    }else{
                        echo "<p>".$data3['0']['justificacion']."</p>";
                    }                
                    ?>
                    </p>                  
                    
                </div>                           
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light btn-block" data-dismiss="modal">Atras</button>                
            </div>
        </form>    
        </div>
    </div>
</div>  


<!-- MARCO  -->

<div class="row">
    <div class="col-lg-12" style="text-align: center;">
        <br>
        <button class="btn btn-success" id="botonAceptar">ACEPTAR</button>
        <button class="btn btn-danger" id="botonRechazar">RECHAZAR</button>
        <button class="btn btn-secondary" id="botonCancelar" value="Cancelar">CANCELAR</button>
    </div>
</div>

<script>
    var id = '<?php echo $_GET['id_solicitud']?>';
    var id_pedido = '<?php echo $_GET['id_pedido']?>';
    var id_usuario = '<?php echo $_GET['id_usuario']?>';

</script>
<script src="../controladores/evaluarPedidoSolicitud.js"></script>



<!--
    <script src="../librerias/jquery/jquery-3.3.1.min.js"></script>-->
    <script src="../librerias/popper/popper.min.js"></script>
    <script src="../librerias/bootstrap/js/bootstrap.min.js"></script>
      
    <!-- datatables JS -->
    <script type="text/javascript" src="../librerias/datatables/datatables.min.js"></script>    
     
    <script type="text/javascript" src="../controladores/controladorVistaDetalle.js"></script>  
    </div>

</div>



<!--Menu sidebar -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/sticky-kit/1.1.3/sticky-kit.min.js"></script>
<script src="../librerias/js/custom.min.js"></script>
</body>
</html>