<?php
    require_once '../configuraciones/conexion.php';
    $conn = new Conexiones();
    $estadoconexion = $conn->getConn();

    $errors = array();
    $error = "";

    if(!empty($_POST)){

        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $nit = $_POST['nit'];
        $telefono = $_POST['telefono'];
        $direccion = $_POST['direccion'];
        $rubro = $_POST['rubro'];
        
        if(empty($nombre) || empty($correo) || empty($nit) || empty($telefono) || empty($direccion) || empty($rubro)){
            $error = "* Todos los campos son obligatorios";
            echo "<p class='error'>".$error."</p>";
            $errors[] = $error;

        }else if(!validarPatron($nombre, "/^[a-zA-Z]([a-zA-Z0-9áÁéÉíÍóÓúÚñÑüÜ\s]+){5}$/")){ 
            $error = "* Nombre no Valido";
            echo "<p class='error'>".$error."</p>";
            $errors[] = $error;
        }else if(!validarPatron($correo, "/\b[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,6}\b/")){
            $error = "* Correo no Valido";
            echo "<p class='error'>".$error."</p>";
            $errors[] = $error;
        }else if(!validarPatron($nit, "/^[1-9]([0-9]{5,15})$/")){
            $error = "* NIT no Valido";
            echo "<p class='error'>".$error."</p>";
            $errors[] = $error;
        }else if(!validarPatron($telefono, "/^[23467]([0-9]{6,8})$/")){
            $error = "* Telefono no Valido";
            echo "<p class='error'>".$error."</p>";
            $errors[] = $error;
        }else if(!validarPatron($direccion, "/^[a-zA-Z]([a-zA-Z0-9áÁéÉíÍóÓúÚñÑüÜ\s#?]+){5}$/")){ 
            $error = "* Direccion no Valida";
            echo "<p class='error'>".$error."</p>";
            $errors[] = $error;
        }else if(!is_numeric($rubro)){ //"/^[a-zA-Z]([a-zA-Z0-9áÁéÉíÍóÓúÚñÑüÜ\s.,()]+){5}$/"
            $error = "* Rubro no Valido";
            echo "<p class='error'>".$error."</p>";
            $errors[] = $error;
        }else if(correoExiste($correo)){
            $error = "* El correo ya fue registrado por otra empresa";
            echo "<p class='error'>".$error."</p>";
            $errors[] = $error;
        }

        echo '<script src="../librerias/js/sweetalert2.all.min.js"></script><script src="../librerias/js/jquery-3.6.0.js"></script>';
        
        if(count($errors) == 0){ //no errores
            $registro = registraEmpresa($nombre, $correo, $nit, $telefono, $direccion, $rubro);
            if($registro > 0){

                echo '<script language="javascript">Swal.fire({
                    title: "EMPRESA REGISTRADA!",
                    text: "La Empresa ha sido registrada con exito",
                    icon: "success",
                    confirmButtonText: "OK",
                    allowOutsideClick: false,
                    closeOnClickOutside: false,
                    allowEnterKey: true
                }).then((result) =>{
                    if(result.isConfirmed){
                        window.location.href="../vista/home.php";
                    }
                })</script>';
                exit;        
            }else{
                echo '<script language="javascript">window.location.href="../vista/home.php"</script>';
                $error = "Error al registrar";
                echo "<p class='error'>".$error."</p>";
                $errors[] = $error;
            }    
        }
        //echo mostrarErrores($errors);
    }

    function validarPatron($str, $patron){
        $str = trim($str);
        if ($str !== '') {
            $pattern = $patron;
            if (preg_match($pattern, $str)) {
                return true;   
            }
        }
        return false;   
    }

    function isEmail($corr){
        if(filter_var($corr, FILTER_VALIDATE_EMAIL)){
            return true;
        }else{
            return false;
        }
    }

    function minMax($min, $max, $valor){
        if(strlen(trim($valor)) < $min){
            return true;
        }else if(strlen(trim($valor)) > $max){
            return true;
        }else{
            return false;
        }
    }

    function registraEmpresa($nombre, $correo, $nit, $telefono, $direccion, $rubro){
        global $estadoconexion;
        
        $stmt = $estadoconexion->prepare("INSERT INTO empresas (nombre_empresa, correo_empresa, rubro, nit, telefono, direccion) VALUES(?,?,?,?,?,?)");
        $stmt->bind_param("ssiiss", $nombre, $correo, $rubro, $nit, $telefono, $direccion);

        if($stmt->execute()){
            return $estadoconexion->insert_id;
        }else{
            return 0;
        }
    }

    function correoExiste($correo){
        global $estadoconexion;

        $stmt = $estadoconexion->prepare("SELECT correo_empresa FROM empresas WHERE correo_empresa = ? LIMIT 1");
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $stmt->store_result();
        $num = $stmt->num_rows;
        $stmt->close();
        
        if($num > 0){
            return true;
        }else{
            return false;
        }
    }

    function mostrarErrores($errors){
        echo count($errors);
        if(count($errors) > 0){
            foreach($errors as $error){
                echo "<li>".$error."</li>";
            }
            echo "</ul>";
            echo "</div>";
        }
    }
?>