<?php include 'php/main-page/consulta-nombre.php'; ?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/imagenes/logo.png" type="image/x-icon">
    <title>Modulo administrar denominacion,codigo y grado certificaciones laborales corpamag</title>
    <link rel="stylesheet" href="assets/css/estilo-modulo-administrar-denominacion-codigo-grado.css">
</head>
<body>
    <header>
        <img src="assets/imagenes/logo.png" alt="Logo Corpamag" class="image-left">
        <div class="user-info" id="user-info">
            <span><?php echo htmlspecialchars($nombreCompleto); ?></span>
            <img src="assets/iconos/menu-hamburguesa.png" alt="Menu" class="menu-icon" id="menu-icon">
        </div>
    </header>
    <div class="dropdown-menu" id="dropdown-menu">
        <button id="logout-button">Salir</button>
    </div>
    <div>
        <button id="back-button" class="boton-azul" onclick="location.href='modulo-admin.php';">&xlarr; Volver</button>
    </div>
    <main>
        <div class="left-div">
            <input type="text" id="search-bar" class="search-bar" placeholder="Buscar...">
            <div id="data-container" class="data-container">
            </div>
        </div>
        <div class="right-div">
            <!-- Contenido del 30% -->
        </div>
    </main>
    <script src="assets/js/script-modulo-administrar-denominacion-codigo-grado.js"></script>
</body>
</html>