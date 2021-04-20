<?php
    require '../conexion.php';
    //require '../controladores/funcionesRUA.php';
    $conn = new Conexion();
    $estadoconexion = $conn->getConn();

    $errors = array();

    if(!empty($_POST)){

        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $correo = $_POST['correo'];
        $unidad_administrativa = $_POST['unidad_administrativa'];
        $rol = $_POST['rol'];
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];
        $password_con = $_POST['password_con'];
        $unidad_gasto = $_POST['unidad_gasto'];

        //validaciones
        if(!isNull($nombres, $apellidos, $correo, $unidad_administrativa,$unidad_gasto, $rol, $usuario, $password, $password_con)){
            $errors[] = "Debe llenar todos los campos";
        }

        if(!isEmail($correo)){
            $errors[] = "Direccion de correo invalida";
        }

        if(!validarPassword($password, $password_con)){
            $errors[] = "Las contrasenas no coinciden";
        }

        if(usuarioExiste($usuario)){
            $errors[] = "El nombre de usuario $usuario ya existe";
        }
        
        if(count($errors) == 0){ //no errores
            $pass_hash = hashPassword($password);

            $registro = registraUsuario($nombres, $apellidos, $correo, $unidad_administrativa, $unidad_gasto, $rol, $usuario, $pass_hash);
            if($registro > 0){
                exit;        
            }else{
                $errors[] = "Error al registrar";
            }    

        }
        echo mostrarErrores($errors);
    }



    function isNull($nom, $apell, $corr, $unidadAd, $unidadGas, $ro, $usu, $pass){
        if(strlen(trim($nom)) < 1 || strlen(trim($apell)) < 1 || strlen(trim($corr)) || strlen(trim($unidadAd)) || strlen(trim($unidadGas)) < 1 || strlen(trim($ro)) < 1 || strlen(trim($usu)) < 1 || strlen(trim($pass)) < 1){
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

    function registraUsuario($nom, $apell, $corr, $unidadAd, $unidadGas, $ro, $usu, $pass){
        global $estadoconexion;

        $stmt = $estadoconexion->prepare("INSERT INTO usuarios (nombres, apellidos, correo, unidad_administrativa, unidad_gasto, rol, usuario, password) VALUES(?,?,?,?,?,?,?,?)");
        $stmt->bind_param("ssssssss", $nom, $apell, $corr, $unidadAd, $unidadGas, $ro, $usu, $pass);

        if($stmt->execute()){
            echo $stmt->insert_id;
            return $estadoconexion->insert_id;
        }else{
            return 0;
        }
    }

    function mostrarErrores($errors){
        echo count($errors);
        if(count($errors) > 0){
            echo "<div id='error' class='alert alert-danger' role='alert'><a href='#' onclick=\"ShowHide('error');\">[X]</a><ul>";

            foreach($errors as $error){
                echo "<li>".$error."</li>";
            }
            echo "</ul>";
            echo "</div>";
        }
    }

?>