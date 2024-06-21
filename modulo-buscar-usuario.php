<?php include 'php/main-page/consulta-nombre.php'; ?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/imagenes/logo.png" type="image/x-icon">
    <title>Modulo buscar usuario certificaciones laborales corpamag</title>
    <link rel="stylesheet" href="assets/css/estilo-modulo-buscar-usuario.css">
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
        <header class="mensaje-filtro-busqueda"><strong>Filtro de Búsqueda usuario</strong></header>
        <div class="contenedor-flex">
            <div class="contenedor-select">
            <label for="CargoSelectionUsuarios"><strong id="strong-cargo">Cargo</strong></label><br>
            <select id="CargoSelectionUsuarios"><br>
                <option>Seleccione un cargo...</option>
            </select>
            </div>
            <div class="contenedor-input">
            <strong>Número de documento</strong><br>
            <input id="input-documento-buscar-usuarios" class="input-documento" type="number" name="documento-buscar-usuarios" placeholder="Ingrese el número de documento">
            </div>
        </div>
        <div class="contenedor-flex">
            <div class="contenedor-parametros">
                <strong>Primer nombre</strong><br>
                <input id="input-primer-nombre-buscar-usuarios" class="input-parametro" type="text" name="primer-nombre-buscar-usuarios" placeholder="Ingrese el prmier nombre">
            </div>
            <div class="contenedor-parametros">
                <strong>Segundo nombre</strong><br>
                <input id="input-segundo-nombre-buscar-usuarios" class="input-parametro" type="text" name="segundo-nombre-buscar-usuarios" placeholder="Ingrese el Segundo nombre">
            </div>
        </div>
        <div class="contenedor-flex">
            <div class="contenedor-parametros">
                <strong>Primer apellido</strong><br>
                <input id="input-primer-apellido-buscar-usuarios" class="input-parametro" type="text" name="primer-apellido-buscar-usuarios" placeholder="Ingrese el primer apellido">
            </div>
            <div class="contenedor-parametros">
                <strong>Segundo apellido</strong><br>
                <input id="input-segundo-apellido-buscar-usuarios" class="input-parametro" type="text" name="segundo-apellido-buscar-usuarios" placeholder="Ingrese el segundo apellido">
            </div>
        </div>
        <div class="botones">
            <button id="buscar-usuario" class="boton-azul">Buscar</button>
            <button id="Limpiar-datos" class="boton-trasnparente">Limpiar</button>
        </div>
        <div>
            <Header class="mensaje-filtro-busqueda"><strong>Usuarios</strong></Header>
            <table id="tabla-de-buscar-usuarios">
                <thead>
                    <tr>
                        <th><strong>Apellidos</strong></th>
                        <th><strong>Nombres</strong></th>
                        <th><strong>Número de documento</strong></th>
                        <th><strong>Fecha vinculacion</strong></th>
                        <th><strong>Cargo</strong></th>
                        <th><strong>Estado</strong></th>
                        <th><strong>Opciones</strong></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </main>
    <script src="assets/js/script-modulo-buscar-usuario.js"></script>
</body>
</html>