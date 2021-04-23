<?php
    require '../conexion.php';
    $conn = new Conexion();
    $estadoconexion = $conn->getConn();

    $errors = array();
    $error = "";

    if(!empty($_POST)){

        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $correo = $_POST['correo'];
        $unidad_administrativa = $_POST['unidad_administrativa'];
        $rol = $_POST['rol'];
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];
        $password_con = $_POST['password_con'];

        if(empty($nombres) || empty($apellidos) || empty($correo) || empty($unidad_administrativa) || empty($rol) || empty($usuario) || empty($password)){
            $error = "* Todos los campos son obligatorios";
            echo "<p class='error'>".$error."</p>";
            $errors[] = $error;
        }else if(!validarPatron($nombres, "/^[a-zA-Z-ñáéíóú, ]*$/")){
            $error = "* Nombre no Valido";
            echo "<p class='error'>".$error."</p>";
            $errors[] = $error;
        }else if(!validarPatron($apellidos, "/^[a-zA-Z-ñáéíóú, ]*$/")){
            $error = "* Apellido no Valido";
            echo "<p class='error'>".$error."</p>";
            $errors[] = $error;
        }else if(!validarPatron($correo, "/\b[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,6}\b/")){
            $error = "* Correo no Valido";
            echo "<p class='error'>".$error."</p>";
            $errors[] = $error;
        }else if(usuarioExiste($usuario)){
            $error = "El nombre de usuario ".$usuario. " ya existe";
            echo "<p class='error'>".$error."</p>";
            $errors[] = $error;
        }else if(!validarPatron($usuario, "/^[a-zA-Z]((\.|_|-)?[a-zA-Z0-9]+){5}$/D")){
            $error = "* Usuario no Valido";
            echo "<p class='error'>".$error."</p>";
            $errors[] = $error;
        }else if(!validarPatron($password, "/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$/")){
            $error = "* Contrasena no Valida";
            echo "<p class='error'>".$error."</p>";
            $errors[] = $error;
        }else if (!validarPassword($password, $password_con)){
            $error = "Las contrasenas no coinciden";
            echo "<p class='error'>".$error."</p>";
            $errors[] = $error;
        }

        if(count($errors) == 0){ //no errores
            $pass_hash = hashPassword($password);

            $registro = registraUsuario($nombres, $apellidos, $correo, $unidad_administrativa, $rol, $usuario, $pass_hash);
            if($registro > 0){
                echo '<script language="javascript">alert("Usuario Registrado..!!");window.location.href="../index.php"</script>';
                exit;        
            }else{
                echo '<script language="javascript">window.location.href="../index.php"</script>';
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

    //(!preg_match("/^(?!-+)[a-zA-Z-ñáéíóú\s]*$/"))

    function isNull($nom, $apell, $corr, $unidadAd, $ro, $usu, $pass){
        if(strlen(trim($nom)) < 1 || strlen(trim($apell)) < 1 || strlen(trim($corr)) || strlen(trim($unidadAd)) < 1 || strlen(trim($ro)) < 1 || strlen(trim($usu)) < 1 || strlen(trim($pass)) < 1){
            return true;
        }else{
            return false;
        }
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

    function usuarioExiste($usu){
        global $estadoconexion;

        $stmt = $estadoconexion->prepare("SELECT id FROM usuarios WHERE usuario = ? LIMIT 1");
        $stmt->bind_param("s", $usu);
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

    function registraUsuario($nom, $apell, $corr, $unidadAd, $ro, $usu, $pass){
        global $estadoconexion;

        $stmt = $estadoconexion->prepare("INSERT INTO usuarios (nombres, apellidos, correo, unidad_administrativa, rol, usuario, password) VALUES(?,?,?,?,?,?,?)");
        $stmt->bind_param("sssssss", $nom, $apell, $corr, $unidadAd, $ro, $usu, $pass);

        if($stmt->execute()){
            //echo $stmt->insert_id;
            return $estadoconexion->insert_id;
        }else{
            return 0;
        }
    }

    function mostrarErrores($errors){
        echo count($errors);
        if(count($errors) > 0){
            //echo "<div id='error' class='alert alert-danger' role='alert'><a href='#' onclick=\"ShowHide('error');\">[X]</a><ul>";

            foreach($errors as $error){
                echo "<li>".$error."</li>";
            }
            echo "</ul>";
            echo "</div>";
        }
    }

?>