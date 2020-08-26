<!-- BARRA LATERAL -->
<aside id="sidebar">

    <!-- LOGIN -->
    <div id="buscador" class="bloque">
        <h3>Buscar</h3>

        <form action="buscar.php" method="POST">
            <input type="text" name="busqueda">
            <input type="submit" value="Buscar">
        </form>
    </div>

    <!-- ÉXITO LOGIN -->
    <?php if(isset($_SESSION['usuario'])): ?>
        <div id="usuario-logueado" class="bloque">
            <h3> Bienvenido, <?= $_SESSION['usuario']['nombre'] . ' ' . $_SESSION['usuario']['apellidos'] ?> </h3> 
            <!-- Botones -->
            <a class="boton  boton-verde" href="crear_entrada.php">Crear entradas</a>
            <a class="boton  boton" href="crear_categoria.php">Crear categoría</a>
            <a class="boton boton-naranja" href="mis_datos.php">Mis datos</a>
            <a class="boton boton-rojo" href="cerrar.php">Cerrar sesión</a>
        </div>
    <?php endif; ?>


    <?php if(!isset($_SESSION['usuario'])): ?>

        <!-- LOGIN -->
        <div id="login" class="bloque">
            <h3>Identifícate</h3>

            <!-- ERROR LOGIN -->
            <?php if(isset($_SESSION['error_login'])): ?>
                <div class="alerta alerta-error">
                    <?= $_SESSION['error_login']; ?> </h3> 
                </div>
            <?php endif; ?>

            <form action="login.php" method="POST">
                <label for="email">Email</label>
                <input type="email" name="email">

                <label for="password">Contraseña</label>
                <input type="password" name="password">

                <input type="submit" value="Enviar">
            </form>
        </div>

        <!-- REGISTRO -->
        <div id="register" class="bloque">
            <h3>Regístrate</h3>

            <!-- ÉXITO/ERROR REGISTRO -->
            <?php 
                if(isset($_SESSION['completado'])): ?>
                    <div class="alerta alerta-exito">
                        <?=$_SESSION['completado']?>
                    </div>
                <?php elseif(isset($_SESSION['errores']['general'])): ?>
                    <div class="alerta alerta-error">
                        <?=$_SESSION['errores']['general']?>
                    </div>
                <?php endif;
            ?>

            <form action="registro.php" method="POST">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" required>
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'nombre') : '' ?>

                <label for="apellidos">Apellidos</label>
                <input type="text" name="apellidos" required>
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'apellidos') : '' ?>

                <label for="email">Email</label>
                <input type="email" name="email" required>
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'email') : '' ?>

                <label for="password">Contraseña</label>
                <input type="password" name="password" required>
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'password') : '' ?>

                <input type="submit" value="Registrar">
            </form>
            <?php borrarErrores(); ?>
        </div>
    <?php endif; ?>
</aside>