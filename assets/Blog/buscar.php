<?php
    if(!isset($_POST['busqueda'])){
        header('Location: index.php');
    }
?>

<?php require_once 'includes/cabecera.php';?>
<?php require_once 'includes/lateral.php';?>

<!-- CAJA PRINCIPAL -->
<div id="principal">

    <h1>Búsqueda: <?= $_POST['busqueda']?></h1>

    <?php
        
        $entradas = conseguirEntradas($db,null,null,$_POST['busqueda']);
        if($entradas):
            while($entrada = mysqli_fetch_assoc($entradas)):
        ?>
        <article class="entrada">
            <a href="entrada.php?id=<?=$entrada['id']?>">
                <h2><?=$entrada['titulo']?></h2>
                <span class="fecha"> <?=$entrada['categoria'] . ' | ' . $entrada['fecha'] ?> </span>
                <p>
                    <?=substr($entrada['descripcion'],0,160)?>
                </p> 
            </a>
        </article>
    <?php
            endwhile;
        else:
    ?>
        <div class="alerta">No hay entradas en esta categoría</div>
    <?php
        endif; 
    ?>

    <div id="ver-todas">
        <a href="entradas.php">Ver todas las entradas</a>
    </div>
    
</div>

<?php require_once 'includes/pie.php';?>
</body>
</html>