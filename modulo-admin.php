<?php include 'php/main-page/consulta-nombre.php'; ?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/imagenes/logo.png" type="image/x-icon">
    <title>Modulo admin certificaciones laborales corpamag</title>
    <link rel="stylesheet" href="assets/css/estilo-modulo-admin.css">
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
    <main>
        <div class="icon-container" id="container-buscar-usuario">
            <img src="assets/iconos/buscar-alt.png" alt="Buscar usuario" class="main-icon" id="buscar-usuario">
            <p>Buscar usuario</p>
        </div>
        <div class="icon-container" id="container-agregar-usuario">
            <img src="assets/iconos/agregar-usuario.png" alt="Agregar usuario" class="main-icon" id="agregar-usuario">
            <p>Agregar usuario</p>
        </div>
        <div class="icon-container" id="container-administrar-nombramientos">
            <img src="assets/iconos/nombramientos.png" alt="Admnisitrar nombramientos" class="main-icon" id="administrar-nombramientos">
            <p>Administrar nombramientos</p>
        </div>
        <div class="icon-container" id="container-administrar-dependencias">
            <img src="assets/iconos/dependencias.png" alt="Admnisitrar dependencias" class="main-icon" id="administrar-dependencias">
            <p>Administrar dependencias</p>
        </div>
        <div class="icon-container" id="container-administrar-denominacion-codigo-grado">
            <img src="assets/iconos/dependencias.png" alt="Admnisitrar denominacion, codigo y grado" class="main-icon" id="administrar-denominacion-codigo-grado">
            <p>Administrar denominacion, codigo y grado</p>
        </div>
        <div class="icon-container" id="container-carga-masiva">
            <img src="assets/iconos/carga-en-la-nube.png" alt="Carga masiva" class="main-icon" id="carga-masiva">
            <p>Carga masiva</p>
        </div>
        <div class="icon-container" id="container-cambiar-plantilla">
            <img src="assets/iconos/agregar-documento.png" alt="Cambiar plantilla" class="main-icon" id="cambiar-plantilla">
            <p>Cambiar plantilla</p>
        </div>
    </main>
    <script src="assets/js/script-modulo-admin.js"></script>
</body>
</html>