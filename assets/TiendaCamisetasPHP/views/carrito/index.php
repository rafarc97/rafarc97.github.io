<h1>Carrito de la compra</h1>

<?php if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) >= 1) : ?>
    <table>
        <tr>
            <th>IMAGEN</th>
            <th>NOMBRE</th>
            <th>PRECIO</th>
            <th>UNIDADES</th>
            <th>ELIMINAR</th>
        </tr>
        <?php
        foreach ($carrito as $indice => $elemento) :
            $producto = $elemento['producto'];
        ?>
            <tr>
                <td>
                    <?php if ($producto->imagen != null) : ?>
                        <img src="<?= base_url ?>uploads/images/<?= $producto->imagen ?>" class="img-carrito">
                    <?php else : ?>
                        <img src="<?= base_url ?>assets/img/camiseta.png<?= $producto->imagen ?>" class="img-carrito">
                    <?php endif; ?>
                </td>
                <td>
                    <a href="<?= base_url ?>producto/ver&id=<?= $producto->id ?>"><?= $producto->nombre ?></a>
                </td>
                <td>
                    <?= $elemento['precio'] ?>
                </td>
                <td>
                    <?= $elemento['unidades'] ?>
                    <div class="updown-unidades">
                        <a href="<?= base_url ?>carrito/up&index=<?= $indice ?>" class="button">+</a>
                        <a href="<?= base_url ?>carrito/down&index=<?= $indice ?>" class="button">-</a>
                    </div>
                </td>
                <td>
                    <a href="<?= base_url ?>carrito/delete&index=<?= $indice ?>" class="button button-carrito button-red">Eliminar producto</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <br>

    <div class="delete-carrito">
        <a href="<?= base_url ?>carrito/deleteAll" class="button button-delete button-red">Vaciar carrito</a>
    </div>

    <div class="total-carrito">
        <?php $stats = Utils::statsCarrito() ?>
        <h3>Precio total: <?= $stats['total'] ?>€</h3>
        <a href="<?= base_url ?>pedido/hacer" class="button button-pedido">Hacer pedido</a>
    </div>
<?php else : ?>

    <p>El carrito está vacío, compra algún producto</p>
<?php endif; ?>