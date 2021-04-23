<?php

include("../controladores/solicitudesController.php");
if(isset($_GET['ruta'])):
    $metodo =   $_GET['ruta'];
    //var_dump($metodo);

    $directorio = new SolicitudesController('.');
//var_dump(method_exists($directorio,$metodo));

    if(method_exists($directorio , $metodo)):
        if(isset($_GET['con'])){

            $condicion= $_GET['con'];    
            SolicitudesController::{$metodo . '_' . $condicion}($condicion);
        }
        else{
            SolicitudesController::{$metodo}();
        }
      
    endif;
else:
    SolicitudesController::mostrar();
endif;


?>