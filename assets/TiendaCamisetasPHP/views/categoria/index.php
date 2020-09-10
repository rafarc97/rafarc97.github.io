<h1>Gestionar categorías</h1>

<a class="button button-small" href="<?= base_url ?>categoria/crear">Crear Categoría</a>
<table >
    <tr>
        <th>ID</th>
        <th>NOMBRE</th>
    </tr>

    <?php while($categoria = $categorias->fetch_object()): ?>
        <tr>
            <td><?= $categoria->id; ?></td>
            <td><?= $categoria->nombre; ?></td>
            
        </tr>
    <?php endwhile; ?>
</table>
