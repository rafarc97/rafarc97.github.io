<?php if (isset($_SESSION['pedido']) && $_SESSION['pedido'] == 'complete') : ?>
    <h1>Tu pedido se ha confirmado</h1>
    <p>Tu pedido ha sido guardado con éxito. Una vez que realices la transferencia bancaria a la cuenta <strong>ES20 2345 1234 2344</strong> con el coste del pedido será procesado y enviado.</p>

    <br>

    <?php if (isset($pedido)) : ?>
        <h3>Datos del pedido</h3>

        Número de pedido: <?= $pedido->id ?>
        <br>
        Total a pagar: <?= $pedido->coste ?>€
        <br>
        Productos:

        <br>
        <br>
        
        <table>
            <tr>
                <th>IMAGEN</th>
                <th>NOMBRE</th>
                <th>PRECIO</th>
                <th>UNIDADES</th>
            </tr>
            <?php while ($producto = $productos->fetch_object()) : ?>
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
                        <?= $producto->precio ?>
                    </td>
                    <td>
                        <?= $producto->unidades ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>

    <?php endif; ?>

<?php elseif (isset($_SESSION['pedido']) && $_SESSION['pedido'] == 'complete') : ?>
    <h1>Tu pedido no ha podido procesarse</h1>
<?php endif; ?>