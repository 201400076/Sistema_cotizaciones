<?php
    session_start();
    $id_pendientes=$_SESSION['usuario'];
    $id_unidad=$_SESSION["unidad"];
    include_once '../modelo/conexionPablo.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();
    $consulta="SELECT count(pedido.id_pedido) from pedido where pedido.id_usuarios='$id_pendientes' and pedido.id_gasto='$id_unidad'";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data1=$resultado->fetchAll(PDO::FETCH_ASSOC);
    $nro=$data1['0']['count(pedido.id_pedido)']+1;
    
    $consulta="SELECT nombres,apellidos FROM usuarios WHERE usuarios.id_usuarios='$id_pendientes'";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data2=$resultado->fetchAll(PDO::FETCH_ASSOC);
    $nombre=$data2['0']['apellidos']." ".$data2['0']['nombres'];
    $consulta="SELECT id_pendientes,cantidad, unidad, detalle,archivo,ruta FROM items_pendientes i WHERE i.id_usuarios='$id_pendientes' and i.id_gasto='$id_unidad'";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
?>
<?php
    include('layouts/navGasto.php')
?>
    <section>
        <div class="row">
            <div class="col-lg-12">
                <h2>Solicitud de Pedido # <?php echo $nro?></h2>
            </div>          
            <div class="col-lg-12">
                <h2>Fecha:  <?php echo date('y-m-d')?></h2>
            </div>
        </div>
    </section>
      
    <div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <button id="btnNuevo" type="button" class="btn btn-success" data-toggle="modal">NUEVO ITEM</button>    
            </div>    
        </div>    
    </div>    
    <br>  
    <div class="container">
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
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {                                                        
                            ?>                            
                            <tr>
                                <td><?php echo $dat['id_pendientes'] ?></td>
                                <td><?php echo $dat['cantidad'] ?></td>
                                <td><?php echo $dat['unidad'] ?></td>
                                <td><?php echo $dat['detalle'] ?></td>
                                <td><a target='_black' href="/Sistema_cotizaciones/archivos/<?php echo $dat['archivo']?>" type='button'> <?php echo $dat['archivo']?> </a></td>                                    
                                <td></td>
                            </tr>
                            <?php
                                }
                            ?>                                
                        </tbody>        
                       </table>                    
                    </div>
                </div>
        </div>  
        <div class="container">
            <div class="form-group" style="width:100%">    
                <div class="col-12">
                    <button type="button" id="btnPedido" class="btn btn-dark text-center btn-block mt-2 mb-8 btnPedido" data-toggle="modalJust">ENVIAR Y GUARDAR</button>
                </div>
            </div>
        </div>
    </div>    
      
<!--Modal para CRUD-->
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
                <label for="cantidad" class="col-form-label">CANTIDAD:</label>
                <input type="number" class="form-control" id="cantidad" placeholder="CANTIDAD*">
                </div>
                <div class="form-group">
                <label for="unidad" class="col-form-label">UNIDAD:</label>
                <input type="text" class="form-control" id="unidad" placeholder="UNIDAD*">
                </div>                
                <div class="form-group">
                <label for="detalle" class="col-form-label">DETALLE:</label>
                <textarea  class="form-control"  id="detalle" cols="20" rows="5" placeholder="Detalle de item..."></textarea>                
                </div>   
                <div class="form-group">
                <label for="unidad" class="col-form-label">archivo:</label>
                <input type="file" class="form-control" id="archivo">
                </div>           
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">CANCELAR</button>
                <button type="submit" id="btnGuardar" class="btn btn-dark">INSERTAR</button>
            </div>
        </form>    
        </div>
    </div>
</div>  

<div class="modal fade" id="modalCRUDJust" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class=" text-center modal-title1" id="exampleModalLabel">Enviar Solicitud de Pedido</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formPersonas">    
            <div class="modal-body">            
                <div class="form-group">
                <label for="Justificacion" class="col-form-label">Justificacion:</label>
                <textarea  class="form-control"  id="Justificacion" cols="20" rows="5" placeholder="Puede agregar una justificacion..."></textarea>                
                </div>                         
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">CANCELAR</button>
                <button type="button" id="btnGuardarJust" class=" btnGuardarJust btn btn-dark">GUARDAR</button>
            </div>
        </form>    
        </div>
    </div>
</div>  
      
    <!-- jQuery, Popper.js, Bootstrap JS -->    
    <script src="../librerias/popper/popper.min.js"></script>
      
    <!-- datatables JS -->
    <script type="text/javascript" src="../librerias/datatables/datatables.min.js"></script>    
     <script>
        var id_usu='<?php echo $id_pendientes?>';
        var id_unidad='<?php echo $id_unidad?>';
     </script>
        <script type="text/javascript" src="../controladores/controladorSolicitudPedido.js"></script>  
    </div>

</div>



<!--Menu sidebar -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/sticky-kit/1.1.3/sticky-kit.min.js"></script>
<script src="../librerias/js/custom.min.js"></script>
<?php
  include('../vista/layouts/piePagina.php')
?>

