<?php include 'php/main-page/consulta-nombre.php'; ?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/imagenes/logo.png" type="image/x-icon">
    <title>Modulo administrar dependencias certificaciones laborales corpamag</title>
    <link rel="stylesheet" href="assets/css/estilo-modulo-administrar-dependencias.css">
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
    <div class="contenedor-dependencias">
        <div class="innerbox-dependencias">
            <h3>Crear dependencia</h3>
            <h4>Nombre de la dependencia</h4>
            <form id="formulario-dependencia" action="php/modulo-administrar-dependencia/guardar-dependencia.php" method="post">
                <input id="input-nombre-dependencia" class="input-parametros-dependencia" type="text" name="nombre-dependencia" placeholder="Ingrese el nombre completo">
                <input type="submit" value="Guardar" class="boton-azul" id="boton-guardar">
                <?php 
                if(isset($_SESSION['error_message_dependencias'])): ?>
                    <div id="error-message-main-dependencias" class="error-message"><?php echo $_SESSION['error_message_dependencias']; ?></div>
                    <?php unset($_SESSION['error_message_dependencias']);
                endif;
                if(isset($_SESSION['success_message_dependencias'])): ?>
                    <div id="success-message-main-dependencias" class="success-message"><?php echo $_SESSION['success_message_dependencias']; ?></div>
                    <?php unset($_SESSION['success_message_dependencias']);
                endif;
                ?>
            </form>
        </div>
        <div class="innerbox-dependencias-editar">
            <h3>Editar dependencia</h3>
            <h4>Nombre de la dependencia</h4>
            <form id="formulario-dependencia-editar" action="php/modulo-administrar-dependencia/editar-dependencia.php" method="post">
                <input id="input-nombre-dependencia-editar" class="input-parametros-dependencia" type="text" name="nombre-dependencia" placeholder="Ingrese el nombre completo">
                <input type="hidden" name="viejo-id" id="viejo-id">
                <input type="submit" value="Guardar" class="boton-azul" id="boton-guardar-editar-dependencia">
                <button type="button" class="boton-trasnparente" id="cancelar-editar-dependencia">Cancelar</button>
                <button type="button" class="boton-rojo" id="eliminar-dependencia">Eliminar</button>
                <?php 
                if(isset($_SESSION['error_message_dependencias'])): ?>
                    <div id="error-message-editar-dependencias" class="error-message"><?php echo $_SESSION['error_message_dependencias']; ?></div>
                    <?php unset($_SESSION['error_message_dependencias']);
                endif;
                if(isset($_SESSION['success_message_dependencias'])): ?>
                    <div id="success-message-editar-dependencias" class="success-message"><?php echo $_SESSION['success_message_dependencias']; ?></div>
                    <?php unset($_SESSION['success_message_dependencias']);
                endif;
                ?>
            </form>
        </div>
        <div id="modal-confirmar-eliminar" class="modal-confirmar">
            <div class="modal-confirmar-content">
                <div class="modal-confirmar-header">
                    <h2>Confirmar eliminación</h2>
                </div>
                <div class="modal-confirmar-body">
                    <p><strong>¿Está seguro de borrar la dependencia?</strong></p>
                </div>
                <div class="modal-confirmar-footer">
                    <button id="confirmar-btn-eliminar" class="boton-azul">Confirmar</button>
                    <button id="cancelar-btn-eliminar" class="boton-rojo">Cancelar</button>
                </div>
            </div>
        </div>
        <div id="modal-confirmar-cambiar-estado" class="modal-confirmar">
            <div class="modal-confirmar-content">
                <div class="modal-confirmar-header-cambiar-estado">
                    <h2>Confirmar cambio de estado</h2>
                </div>
                <div class="modal-confirmar-body">
                    <p><strong>¿Está seguro de cambiar el estado de la dependencia?</strong></p>
                </div>
                <div class="modal-confirmar-footer">
                    <button id="confirmar-btn-cambiar-estado" class="boton-azul">Confirmar</button>
                    <button id="cancelar-btn-cambiar-estado" class="boton-rojo">Cancelar</button>
                </div>
                <?php 
                if(isset($_SESSION['error_message_dependencias'])): ?>
                    <div id="error-message-eliminar-dependencias" class="error-message"><?php echo $_SESSION['error_message_dependencias']; ?></div>
                    <?php unset($_SESSION['error_message_dependencias']);
                endif;
                if(isset($_SESSION['success_message_dependencias'])): ?>
                    <div id="success-message-eliminar-dependencias" class="success-message"><?php echo $_SESSION['success_message_dependencias']; ?></div>
                    <?php unset($_SESSION['success_message_dependencias']);
                endif;
                ?>
            </div>
        </div>
        <div class="box-dependencias">
            <input type="text" id="busqueda-dependencias" placeholder="Filtrar por nombre dependencia">
            <button id="boton-pagina-dependencias" class="boton-azul"></button>
            <span id="tres-puntos">...</span>
            <button id="boton-mostrando-dependencias" class="boton-trasnparente">Mostrando del <span id="rango-actual"></span> al <span id="total-actual"></span> de <span id="total-bd"></span></button>
            <button id="anterior-dependencias" class="boton-trasnparente">Anterior</button>
            <button id="siguiente-dependencias" class="boton-trasnparente">Siguiente</button>
            <div>
                <header id="mensaje-tabla-dependencias"><strong>dependencias</strong></header>
                <table id="tabla-dependencias">
                    <thead>
                        <tr>
                            <th colspan="2"><strong>Nombre</strong></th>
                            <th><strong>Estado</strong></th>
                            <th><strong>Opciones</strong></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <script src="assets/js/script-modulo-administrar-dependencias.js"></script>
</body>
</html>