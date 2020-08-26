<?php require_once 'includes/redireccion.php'; ?>
<?php  require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/lateral.php'; ?>

<!-- CAJA PRINCIPAL -->
<div id="principal">
    <h1>Crear Entradas</h1>
    <p>Añade nuevas entradas al blog para que los usuarios puedan leerlas y disfrutar de nuestro contenido.</p>

    <br>

    <form action="guardar_entrada.php" method="POST">
        <label for="titulo">Título:</label>
        <input type="text" name="titulo">
        <?php echo isset($_SESSION['errores_entradas']) ? mostrarError($_SESSION['errores_entradas'],'titulo') : '' ?>

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion"></textarea>
        <?php echo isset($_SESSION['errores_entradas']) ? mostrarError($_SESSION['errores_entradas'],'descripcion') : '' ?>

        <label for="categoria">Categoría:</label>
        <select name="categoria">
        <?php echo isset($_SESSION['errores_entradas']) ? mostrarError($_SESSION['errores_entradas'],'categoria') : '' ?>
            <?php 
                $categorias = conseguirCategorias($db);
                if($categorias):
                    while($categoria = mysqli_fetch_assoc($categorias)):
            ?>
                <option value="<?= $categoria['id'] ?>">
                        <?= $categoria['nombre'] ?>
                </option>
            <?php
                    endwhile;
                endif;
            ?>  
        </select>
        <input type="submit" value="Guardar">
    </form>
    <?php borrarErrores()?>
</div>

<?php require_once 'includes/pie.php';?>

</body>
</html>