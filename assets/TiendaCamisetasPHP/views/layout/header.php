<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=base_url?>assets/css/styles.css">
    <title>Tienda de Camisetas</title>
</head>
<body>

    <div id="container">
        
        <!-- CABECERA -->
        <header id="header">
            <div id="logo">
                <img src="<?=base_url?>assets/img/camiseta.png" alt="Camiseta Logo">
                <a href="index.php">
                    Tienda de Camisetas
                </a>
            </div>
        </header>

        <!-- MENÚ -->
        <?php $categorias = Utils::showCategorias(); ?>
        <nav id="menu">
            <ul>
                <li> 
                    <a href="<?=base_url?>">Inicio</a> 
                </li>
                <?php while($categoria = $categorias->fetch_object()): ?>
                    <li> <a href="<?=base_url?>categoria/ver&id=<?=$categoria->id?>"><?=$categoria->nombre?></a> </li>
                <?php endwhile; ?>
            </ul>
        </nav>

        <div id="content">