<?php
    require '../configuraciones/conexion.php';
    $conn = new Conexiones();
    $estadoconexion = $conn->getConn();

    $errors = array();
    $error = "";

    if(!empty($_POST)){

        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $correo = $_POST['correo'];
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];
        $password_con = $_POST['password_con'];

        if(empty($nombres) || empty($apellidos) || empty($correo) || empty($usuario) || empty($password) || empty($password_con)){
            $error = "* Todos los campos son obligatorios";
            echo "<p class='error'>".$error."</p>";
            $errors[] = $error;
        }else if(!validarPatron($nombres, "/^[a-zA-Z-ñáéíóú, ]*$/")){
            $error = "* Nombre(s) no Valido";
            echo "<p class='error'>".$error."</p>";
            $errors[] = $error;
        }else if(!validarPatron($apellidos, "/^[a-zA-Z-ñáéíóú, ]*$/")){
            $error = "* Apellido(s) no Valido";
            echo "<p class='error'>".$error."</p>";
            $errors[] = $error;
        }else if(!validarPatron($correo, "/\b[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,6}\b/")){
            $error = "* Correo no Valido";
            echo "<p class='error'>".$error."</p>";
            $errors[] = $error;
        }else if(usuarioExiste($usuario)){
            $error = "* El nombre de usuario '".$usuario. "' ya existe";
            echo "<p class='error'>".$error."</p>";
            $errors[] = $error;
        }else if(!validarPatron($usuario, "/^[a-zA-Z]((\.|_|-)?[a-zA-Z0-9]+){5}$/D")){
            $error = "* Usuario no Valido";
            echo "<p class='error'>".$error."</p>";
            $errors[] = $error;
        }else if(!validarPatron($password, "/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$/")){
            $error = "* Contraseña no Valida";
            echo "<p class='error'>".$error."</p>";
            $errors[] = $error;
        }else if (!validarPassword($password, $password_con)){
            $error = "* Las contraseñas no coinciden";
            echo "<p class='error'>".$error."</p>";
            $errors[] = $error;
        }

        if(count($errors) == 0){ //no errores
            $pass_hash = hashPassword($password);

            $registro = registraUsuario($nombres, $apellidos, $correo, $usuario, $pass_hash);
            if($registro > 0){
                echo '<script src="../librerias/js/sweetalert2.all.min.js"></script><script src="../librerias/js/jquery-3.6.0.js"></script>';
                echo '<script language="javascript">Swal.fire({
                    title: "USUARIO REGISTRADO!",
                    text: "El Usuario ha sido registrado con exito",
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

    function validarPassword($password1, $password2) {
        if(strcmp($password1, $password2) !== 0){
            return false;
        }else{
            return true;
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

    function usuarioExiste($usuario){
        global $estadoconexion;

        $stmt = $estadoconexion->prepare("SELECT id_usuarios FROM usuarios WHERE usuario = ? LIMIT 1");
        $stmt->bind_param("s", $usuario);
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

    function hashPassword($pass){
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        return $hash;
    }

    function registraUsuario($nom, $apell, $corr, $usu, $pass){
        global $estadoconexion;

        $stmt = $estadoconexion->prepare("INSERT INTO usuarios (nombres, apellidos, correo, usuario, password) VALUES(?,?,?,?,?)");
        $stmt->bind_param("sssss", $nom, $apell, $corr, $usu, $pass);

        if($stmt->execute()){
            return $estadoconexion->insert_id;
        }else{
            return 0;
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