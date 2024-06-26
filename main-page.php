<?php include 'php/main-page/consulta-nombre.php'; ?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/imagenes/logo.png" type="image/x-icon">
    <title>Certificaciones laborales corpamag</title>
    <link rel="stylesheet" href="assets/css/estilo-main-page.css">
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
        <div class="icon-container" id="container-certificado-sin-salario">
            <img src="assets/iconos/documento-firmado.png" alt="Certificado sin salario" class="main-icon" id="certificado-sin-salario">
            <p>Certificacion sin salario</p>
        </div>
        <div class="icon-container" id="container-certificado-con-salario">
            <img src="assets/iconos/money-cheque-editar.png" alt="Certificado con salario" class="main-icon" id="certificado-con-salario">
            <p>Certificacion con salario</p>
        </div>
    </main>
    <script src="assets/js/script-main-page.js"></script>
</body>
</html>