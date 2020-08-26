<?php
    require_once 'includes/conexion.php';

    if(isset($_POST)){

        //Borrar error antiguo
        if(isset($_SESSION['error_login'])){
            unset($_SESSION['error_login']);
        }

        //Recoger datos formulario
        $email = trim($_POST['email']);
        $password = $_POST['password'];

        $sql = "SELECT * FROM usuarios WHERE email = '$email'";
        $login = mysqli_query($db,$sql);

        if($login && mysqli_num_rows($login) == 1){
            $usuario = mysqli_fetch_assoc($login);
            $verify = password_verify($password,$usuario['password']);

            if($verify){
                $_SESSION['usuario'] = $usuario;
            }else{
                $_SESSION['error_login'] = 'Login incorrecto....';
            }
        }else{
            $_SESSION['error_login'] = 'Login incorrecto....';
        }
    }
    header('Location: index.php');
?>