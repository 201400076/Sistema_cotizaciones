<?php
  include('vista/layouts/navIndex.php');
?>
  <div class="container" style="width: 650px;margin-top: 0;">                        
        <form action="" method="POST">            
            <div class="row">
                <div class="col-25">
                    <label for="usuario">USUARIO :</label>
                </div>
                <div class="col-75">
                    <input type="text" id="usuario" name="usuario" placeholder="Usuario">
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                    <label for="password">PASSWORD :</label>
                </div>
                <div class="col-75">
                    <input type="password" id="password" name="password" placeholder="Password" >
                </div>
            </div>                     
            <div class="row">
                <div class="col">
                <button type="button" id="ingresar" class="btn btn-dark text-center btn-block mt-2 mb-2 ingresar">INGRESAR</button>
                </div>                
            </div>
        </form>   
    </div>
    <script src="controladores/controladorIngreso.js"></script>
    <div class="container-fluid footer pb-8">
  <div class="row">
    <div class="col">
      © Sitio web desarrollado y gestionado por la grupo empresa PF S.R.L
    </div>
  </div>
  <div class="row">
    <div class="col">
      contactos:(+591) 76436540 – 44355215
    </div>
  </div>
</div>

</body>
</html>