<?php include 'php/main-page/consulta-nombre.php'; ?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/imagenes/logo.png" type="image/x-icon">
    <title>Otra Página - Corpamag</title>
    <link rel="stylesheet" href="assets/css/estilo-certificado-sin-sueldo.css">
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
    <div class="full-width">
        <button id="back-button" onclick="location.href='main-page.php';">&xlarr; Volver</button>
    </div>
    <main>
        <header class="mensaje-certificado-sin-sueldo"><strong>CERTIFICADO SIN SUELDO</strong></header>
        <button id="download-button" onclick="location.href='php/certificado-sin-sueldo/generar-certificado.php?cedula=<?php echo urlencode($cedula); ?>';">
            Descargar certificado sin sueldo
        </button>
    </main>
    <script src="assets/js/script-certficado-sin-sueldo.js"></script>
</body>
</html>
