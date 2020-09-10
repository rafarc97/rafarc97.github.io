<?php if(isset($edit) && isset($producto) && is_object($producto)): ?>
    <h1>Editar producto <?=$producto->nombre?></h1>
    <?php $url_action = base_url. 'producto/save&id=' . $producto->id; ?>
<?php else: ?>
    <h1>Crear nuevo producto</h1>
    <?php 
        $url_action = base_url. 'producto/save';
    ?>
<?php endif; ?>

<form action="<?=$url_action?>" method="POST" enctype="multipart/form-data" class="form_container">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" value="<?=isset($producto) && is_object($producto) ? $producto->nombre : '';?>">

    <label for="descripcion">Descripción</label>
    <textarea name="descripcion" ><?=isset($producto) && is_object($producto) ? $producto->descripcion : '';?></textarea>

    <label for="precio">Precio</label>
    <input type="text" name="precio" value="<?=isset($producto) && is_object($producto) ? $producto->precio : '';?>">

    <label for="stock">Stock</label>
    <input type="number" name="stock" value="<?=isset($producto) && is_object($producto) ? $producto->stock : '';?>">

    <label for="categoria">Categoria</label>
    <?php $categorias = Utils::showCategorias(); ?>
    <select name="categoria">
        <?php while($categoria = $categorias->fetch_object()): ?>
            <option value="<?= $categoria->id?>" <?=isset($producto) && is_object($producto) && $categoria->id == $producto->categoria_id ? 'selected' : '';?>> 
                <?=$categoria->nombre?>
            </option>
        <?php endwhile; ?>
    </select>

    <label for="imagen">Imagen</label>
    <?php if(isset($producto) && is_object($producto) && !empty($producto->imagen)): ?> 
        <img src="<?=base_url?>/uploads/images/<?=$producto->imagen?>" alt="">
    <?php endif; ?>
    <input type="file" name="imagen">

    <input type="submit" value="Guardar">
</form>