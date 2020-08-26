<?php
    

    /* mysqli_real_escape..... evita injección SQL */
    if(isset($_POST)){

        require_once 'includes/conexion.php';

        $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db,$_POST['nombre']) : false;
        $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($db,trim($_POST['apellidos'])) : false;
        $email = isset($_POST['email']) ? mysqli_real_escape_string($db,$_POST['email']) : false;
        $password = isset($_POST['password']) ? mysqli_real_escape_string($db,$_POST['password']) : false;

        $errores = array();

        // Validar nombre
        /* neccesary preg_match? */
        if(!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/",$nombre)){
            $nombre_validado = true;
        }else{
            $nombre_validado = false;
            $errores['nombre'] = "El nombre no es válido";
        }

        // Validar apellidos
        if(!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/",$apellidos)){
            $apellidos_validado = true;
        }else{
            $apellidos_validado = false;
            $errores['apellidos'] = "Los apellidos no son válidos";
        }

        // Validar email
        if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
            $email_validado = true;
        }else{
            $email_validado = false;
            $errores['email'] = "El email no es válido";
        }

        // Validar password
        if(!empty($password)){
            $password_validado = true;
        }else{
            $password_validado = false;
            $errores['password'] = "La contraseña está vacía";
        }

        $guardar_usuario = false;

        if(count($errores) == 0){
            $guardar_usuario = true;

            // Cifrar contraseña (seguridad x 4 veces, esto puede aumentarse)
            $password_segura = password_hash($password,$PASSWORD_BCRYPT, ['cost'=>4]);

            // Comprobar si coincide contraseña original con la cifrada
            //password_verify($password,$password_segura); // Devuelve true

            $sql = "INSERT INTO usuarios VALUES(null,'$nombre','$apellidos','$email','$password_segura',CURDATE())";
            $guardar = mysqli_query($db,$sql);

            if($guardar){
                $_SESSION['completado'] = "El registro se ha completado con éxito";
            }else{
                $_SESSION['errores']['general'] = "Fallo al guardar el usuario...";
            }

        }else{
            $_SESSION['errores'] = $errores;
        }
    }
    header('Location: index.php');
?>