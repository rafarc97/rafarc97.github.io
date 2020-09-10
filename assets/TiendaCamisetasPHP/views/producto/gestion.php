<h1>Gestión de productos</h1>

<a class="button button-small" href="<?= base_url ?>producto/crear">Crear Producto</a>

<?php if(isset($_SESSION['producto']) && $_SESSION['producto'] == 'complete'): ?>
    <strong class="alert_green">El producto se ha creado satisfactoriamente</strong>
<?php elseif(isset($_SESSION['producto']) && $_SESSION['producto'] != 'complete'): ?>
    <strong class="alert_red">El producto NO se ha creado correctamente</strong>
<?php endif; ?>

<?php if(isset($_SESSION['delete']) && $_SESSION['delete'] == 'complete'): ?>
    <strong class="alert_green">El producto se ha borrado satisfactoriamente</strong>
<?php elseif(isset($_SESSION['delete']) && $_SESSION['delete'] != 'complete'): ?>
    <strong class="alert_red">El producto NO se ha borrado correctamente</strong>
<?php endif; ?>

<?php Utils::deleteSession('delete'); ?>

<table >
    <tr>
        <th>ID</th>
        <th>NOMBRE</th>
        <th>PRECIO</th>
        <th>STOCK</th>
        <th>ACCIONES</th>
    </tr>

    <?php while($producto = $productos->fetch_object()): ?>
        <tr>
            <td><?= $producto->id; ?></td>
            <td><?= $producto->nombre; ?></td>
            <td><?= $producto->precio; ?></td>
            <td><?= $producto->stock; ?></td>
            <td>
                <!-- usamos '&id' en la url porque es el 3er parámetro que estamos pasando -->
                <!-- para pasar el primer usamos '?' -->
                <a href="<?=base_url?>producto/editar&id=<?=$producto->id?>" class="button button-gestion">Editar</a>
                <a href="<?=base_url?>producto/eliminar&id=<?=$producto->id?>" class="button button-gestion button-red">Eliminar</a>
            </td>
            
        </tr>
    <?php endwhile; ?>
</table>