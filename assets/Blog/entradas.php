<?php require_once 'includes/cabecera.php';?>
<?php require_once 'includes/lateral.php';?>

<!-- CAJA PRINCIPAL -->
<div id="principal">
    <h1>Todas las entradas</h1>

    <?php
        
        $entradas = conseguirEntradas($db);
        if($entradas):
            while($entrada = mysqli_fetch_assoc($entradas)):
        ?>
        <article class="entrada">
            <a href="entrada.php?id=<?=$entrada['id']?>">
                
                <h2><?=$entrada['titulo']?></h2>
                <span class="fecha"> <?=$entrada['categoria'] . ' | ' . $entrada['fecha']  ?> </span>
                <p>
                    <?=substr($entrada['descripcion'],0,160)?>
                </p> 
            </a>
        </article>
    <?php
            endwhile;
        endif;
    ?>
    
    <div id="ver-todas">
        <a href="entradas.php">Ver todas las entradas</a>
    </div>
</div>

<?php require_once 'includes/pie.php';?>
</body>
</html>