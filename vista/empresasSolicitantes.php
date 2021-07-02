<?php
    session_start();    
    include('layouts/navAdministracion.php')
?>        
    <div class="container" style="width: 650px;margin-top: 0;">
        
        <h2>Empresa participante</h2>
        
        <form action="  " method="POST">            
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
    <script src="../controladores/ingresoEmpresaSolicitante.js"></script>
<?php
  include('../vista/layouts/piePagina.php')
?>