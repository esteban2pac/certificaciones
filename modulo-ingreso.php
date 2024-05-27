<?php session_start(); ?>
<!DOCTYPE html>
    <html lang="es" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="assets/imagenes/logo.png" type="image/x-icon">
        <title>Busqueda certificaciones laborales corpamag</title>
        <link rel="stylesheet" href="assets/css/estilo-modulo-ingreso.css">
    </head>
    <body>
        <header>
            <img src="assets/imagenes/logo.png" alt="Logo Corpamag" class="image-left">
        </header>
        <main>
            <section class="modulo-ingreso">
                <h5>Ingreso modulo certificaciones</h5>
                <form action="php/modulo-ingreso/procesar_ingreso.php" method="POST">
                    <input class="controls" type="text" name="cedula" placeholder="Ingrese su cedula">
                    <input class="buttons" type="submit" value="Ingresar">
                </form>
                <?php 
                if(isset($_SESSION['error_message'])): ?>
                    <div id="error-message-modulo-ingreso"class="error-message"><?php echo $_SESSION['error_message']; ?></div>
                    <?php unset($_SESSION['error_message']);
                endif; ?>
            </section>
        </main>
        <script src="assets/js/script-modulo-ingreso.js"></script>
    </body>
</html>