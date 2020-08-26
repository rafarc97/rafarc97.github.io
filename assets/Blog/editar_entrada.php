<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/helpers.php';?>
<?php require_once 'includes/conexion.php';?>
<?php
    $entrada_actual = conseguirEntrada($db,$_GET['id']);
    if(!isset($entrada_actual['id'])){
        header('Location: index.php');
    }
?>

<?php require_once 'includes/cabecera.php';?>
<?php require_once 'includes/lateral.php';?>

<!-- CAJA PRINCIPAL -->
<div id="principal">
    <h1>Editar Entradas</h1>
    <p>Edita tu entrada <?= $entrada_actual['titulo']?></p>

    <br>

    <form action="guardar_entrada.php?editar=<?= $entrada_actual['id'] ?>" method="POST">
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" value="<?= $entrada_actual['titulo']?>">
        <?php echo isset($_SESSION['errores_entradas']) ? mostrarError($_SESSION['errores_entradas'],'titulo') : '' ?>

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion"><?= $entrada_actual['descripcion']?></textarea>
        <?php echo isset($_SESSION['errores_entradas']) ? mostrarError($_SESSION['errores_entradas'],'descripcion') : '' ?>

        <label for="categoria">Categoría:</label>
        <select name="categoria">
        <?php echo isset($_SESSION['errores_entradas']) ? mostrarError($_SESSION['errores_entradas'],'categoria') : '' ?>
            <?php 
                $categorias = conseguirCategorias($db);
                if($categorias):
                    while($categoria = mysqli_fetch_assoc($categorias)):
            ?>
                <option value="<?= $categoria['id'] ?>"
                    <?= ($categoria['id'] == $entrada_actual['categoria_id']) ? 'selected=selected' : '' ?>
                >
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