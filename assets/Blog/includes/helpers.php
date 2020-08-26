<?php

    function mostrarError($errores,$campo){
        if(isset($errores[$campo]) && !empty($campo)){
            $alerta = "<div class='alerta alerta-error'>" . $errores[$campo] . '</div>';
            return $alerta;
        }
    }

    function borrarErrores(){
        $borrado = false;

        if(isset($_SESSION['errores'])){
            $_SESSION['errores'] = null;
            unset($_SESSION['errores']);
            $borrado = true;
        }

        if(isset($_SESSION['errores_entradas'])){
            $_SESSION['errores_entradas'] = null;
            unset($_SESSION['errores_entradas']);
            $borrado = true;
        }

        if(isset($_SESSION['completado'])){
            $_SESSION['completado'] = null;
            unset($_SESSION['completado']);
            $borrado = true;
        }
    }

    function conseguirCategorias($conexion){
        $sql = "SELECT * FROM categorias ORDER BY id ASC";
        $categorias = mysqli_query($conexion,$sql);

        $result = array();
        if($categorias && mysqli_num_rows($categorias) >= 1){
            $result = $categorias;
        }
        return $result;
    }

    function conseguirCategoria($conexion,$id){
        $sql = "SELECT * FROM categorias WHERE id = $id";
        $categorias = mysqli_query($conexion,$sql);

        $result = array();
        if($categorias && mysqli_num_rows($categorias) >= 1){
            $result = mysqli_fetch_assoc($categorias);
        }
        return $result;
    }

    function conseguirEntradas($conexion,$limit=null,$categoria=null,$busqueda=null){
        $sql = "SELECT e.*, c.nombre as 'categoria' FROM entradas e " .
                "INNER JOIN categorias c ON e.categoria_id = c.id ";

        if(!empty($categoria)){
            $sql .= "WHERE e.categoria_id = $categoria ";
        }

        if(!empty($busqueda)){
            $sql .= "WHERE e.titulo LIKE '%$busqueda%' ";
        }

        $sql .= "ORDER BY e.id DESC ";
        if($limit){
            // $sql = $sql . "LIMIT 4";
            $sql .= "LIMIT 4";
        }
        $entradas = mysqli_query($conexion,$sql);

        $result = array();

        if($entradas && mysqli_num_rows($entradas) >= 1){
            $result = $entradas;
        }

        return $result;
    }

    function conseguirEntrada($conexion,$id){
        $sql = "SELECT e.*, c.nombre as 'categoria', CONCAT(u.nombre, ' ', u.apellidos) as usuario FROM entradas e " .
                "INNER JOIN categorias c ON e.categoria_id = c.id " . 
                "INNER JOIN usuarios u ON e.usuario_id = u.id " . 
                "WHERE e.id = $id";
        $entrada = mysqli_query($conexion,$sql);

        $result = array();
        if($entrada && mysqli_num_rows($entrada) == 1){
            $result = mysqli_fetch_assoc($entrada);
        }

        return $result;
    }
?>