<?php
  include('vista/layouts/navIndex.php')
?>
<div class="container-fluid">
      <div class="row nav pt-2">
        <div class=" col-10">          
            <h1 class="pb-2">Sistema de cotizacion</h1>                         
        </div>          
      </div>               
</div>
  <div class="container" style="width: 650px;margin-top: 0;">                        
        <form action="controladores/ingresoSolicitante.php" method="POST">            
            <div class="row">
                <div class="col-25">
                    <label for="usuario">Usuario:</label>
                </div>
                <div class="col-75">
                    <input type="text" id="usuario" name="usuario" placeholder="Usuario">
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                    <label for="password">Password:</label>
                </div>
                <div class="col-75">
                    <input type="password" id="password" name="password" placeholder="Password" >
                </div>
            </div>         
            <div class="row">
                <div class="col">
                <button type="button" id="ingresar" class="btn btn-dark text-center btn-block mt-2 mb-2 ingresar" data-toggle="modalJust">Ingresar</button>
                </div>                
            </div>
        </form>   
    </div>
    <script src="controladores/controladorIngreso.js"></script>
<?php
  include('vista/layouts/piePagina.php')
?>
