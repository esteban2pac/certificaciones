<?php include 'php/main-page/consulta-nombre.php'; ?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/imagenes/logo.png" type="image/x-icon">
    <title>Modulo administrar nombramientos certificaciones laborales corpamag</title>
    <link rel="stylesheet" href="assets/css/estilo-modulo-administrar-nombramiento.css">
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
    <div class="contenedor-nombramientos">
        <div class="innerbox-nombramientos">
            <h3>Crear nombramiento</h3>
            <h4>tipo del nombramiento</h4>
            <form id="formulario-nombramiento" action="php/modulo-administrar-nombramiento/guardar-nombramiento.php" method="post">
                <input id="input-tipo-nombramiento" class="input-parametros-nombramiento" type="text" name="tipo-nombramiento" placeholder="Ingrese el tipo completo">
                <input type="submit" value="Guardar" class="boton-azul" id="boton-guardar">
                <?php 
                if(isset($_SESSION['error_message_nombramientos'])): ?>
                    <div id="error-message-main-nombramientos" class="error-message"><?php echo $_SESSION['error_message_nombramientos']; ?></div>
                    <?php unset($_SESSION['error_message_nombramientos']);
                endif;
                if(isset($_SESSION['success_message_nombramientos'])): ?>
                    <div id="success-message-main-nombramientos" class="success-message"><?php echo $_SESSION['success_message_nombramientos']; ?></div>
                    <?php unset($_SESSION['success_message_nombramientos']);
                endif;
                ?>
            </form>
        </div>
        <div class="innerbox-nombramientos-editar">
            <h3>Editar nombramiento</h3>
            <h4>tipo del nombramiento</h4>
            <form id="formulario-nombramiento-editar" action="php/modulo-administrar-nombramiento/editar-nombramiento.php" method="post">
                <input id="input-tipo-nombramiento-editar" class="input-parametros-nombramiento" type="text" name="tipo-nombramiento" placeholder="Ingrese el tipo completo">
                <input type="hidden" name="viejo-id" id="viejo-id">
                <input type="submit" value="Guardar" class="boton-azul" id="boton-guardar-editar-nombramiento">
                <button type="button" class="boton-trasnparente" id="cancelar-editar-nombramiento">Cancelar</button>
                <button type="button" class="boton-rojo" id="eliminar-nombramiento">Eliminar</button>
                <?php 
                if(isset($_SESSION['error_message_nombramientos'])): ?>
                    <div id="error-message-editar-nombramientos" class="error-message"><?php echo $_SESSION['error_message_nombramientos']; ?></div>
                    <?php unset($_SESSION['error_message_nombramientos']);
                endif;
                if(isset($_SESSION['success_message_nombramientos'])): ?>
                    <div id="success-message-editar-nombramientos" class="success-message"><?php echo $_SESSION['success_message_nombramientos']; ?></div>
                    <?php unset($_SESSION['success_message_nombramientos']);
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
                    <p><strong>¿Está seguro de borrar la nombramiento?</strong></p>
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
                    <p><strong>¿Está seguro de cambiar el estado del nombramiento?</strong></p>
                </div>
                <div class="modal-confirmar-footer">
                    <button id="confirmar-btn-cambiar-estado" class="boton-azul">Confirmar</button>
                    <button id="cancelar-btn-cambiar-estado" class="boton-rojo">Cancelar</button>
                </div>
                <?php 
                if(isset($_SESSION['error_message_nombramientos'])): ?>
                    <div id="error-message-eliminar-nombramientos" class="error-message"><?php echo $_SESSION['error_message_nombramientos']; ?></div>
                    <?php unset($_SESSION['error_message_nombramientos']);
                endif;
                if(isset($_SESSION['success_message_nombramientos'])): ?>
                    <div id="success-message-eliminar-nombramientos" class="success-message"><?php echo $_SESSION['success_message_nombramientos']; ?></div>
                    <?php unset($_SESSION['success_message_nombramientos']);
                endif;
                ?>
            </div>
        </div>
        <div class="box-nombramientos">
            <input type="text" id="busqueda-nombramientos" placeholder="Filtrar por tipo nombramiento">
            <button id="boton-pagina-nombramientos" class="boton-azul"></button>
            <span id="tres-puntos">...</span>
            <button id="boton-mostrando-nombramientos" class="boton-trasnparente">Mostrando del <span id="rango-actual"></span> al <span id="total-actual"></span> de <span id="total-bd"></span></button>
            <button id="anterior-nombramientos" class="boton-trasnparente">Anterior</button>
            <button id="siguiente-nombramientos" class="boton-trasnparente">Siguiente</button>
            <div>
                <header id="mensaje-tabla-nombramientos"><strong>Nombramientos</strong></header>
                <table id="tabla-nombramientos">
                    <thead>
                        <tr>
                            <th colspan="2"><strong>tipo</strong></th>
                            <th><strong>Estado</strong></th>
                            <th><strong>Opciones</strong></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
    <script src="assets/js/script-modulo-administrar-nombramientos.js"></script>
</body>
</html>