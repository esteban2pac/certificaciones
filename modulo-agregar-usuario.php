<?php include 'php/main-page/consulta-nombre.php'; ?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/imagenes/logo.png" type="image/x-icon">
    <title>Modulo agregar usuario certificaciones laborales corpamag</title>
    <link rel="stylesheet" href="assets/css/estilo-modulo-agregar-usuario.css">
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
        <header class="mensaje-agregar-usuario"><strong>Agregar Usuario</strong></header>
        <div class="contenedor-flex">
            <div class="contenedor-parametros">
                <label for="documentoSelection"><strong>Tipo de documento</strong></label><br>
                <select id="documentoSelection">
                    <option>Seleccione un tipo de documento</option>
                    <option value="c.c.">C.C. Cedula de ciudadania</option>
                    <option value="c.e.">C.E. Cedula de extranjero</option>
                </select>
            </div>
            <div class="contenedor-parametros">
                <strong>Número de documento</strong>
                <input id="input-documento" class="input-documento" type="number" name="documento" placeholder="Ingrese el número de documento">
            </div>
        </div>
        <div class="contenedor-parametro-unico">
            <label for="generoSelection"><strong>Género</strong></label><br>
                <select id="generoSelection">
                    <option>Seleccione género</option>
                    <option value="femenino">Femenino</option>
                    <option value="masculino">Masculino</option>
                </select>
        </div>
        <div class="contenedor-flex">
            <div class="contenedor-parametros">
                <strong>Primer nombre</strong><br>
                <input id="input-primer-nombre" class="input-parametro" type="text" name="primer-nombre" placeholder="Ingrese el prmier nombre">
            </div>
            <div class="contenedor-parametros">
                <strong>Segundo nombre</strong><br>
                <input id="input-segundo-nombre" class="input-parametro" type="text" name="segundo-nombre" placeholder="Ingrese el Segundo nombre">
            </div>
        </div>
        <div class="contenedor-flex">
            <div class="contenedor-parametros">
                <strong>Primer apellido</strong><br>
                <input id="input-primer-apellido" class="input-parametro" type="text" name="primer-apellido" placeholder="Ingrese el primer apellido">
            </div>
            <div class="contenedor-parametros">
                <strong>Segundo apellido</strong><br>
                <input id="input-segundo-apellido" class="input-parametro" type="text" name="segundo-apellido" placeholder="Ingrese el segundo apellido">
            </div>
        </div>
        <div class="contenedor-flex">
            <div class="contenedor-parametros">
                <strong>Salario</strong><br>
                <input id="salarioUsuario" class="input-parametro" type="text" name="salario-usuario" placeholder="Ingrese salario del usuario">
            </div>
            <div class="contenedor-parametros">
                <label for="selectionBonoSalarial"><strong>¿Tiene bono salarial?</strong></label><br>
                <select id="selectionBonoSalarial">
                    <option>Seleccione una opción</option>
                    <option value="no">No</option>
                    <option value="coordinacion">Coordinación</option>
                    <option value="prima tecnica salarial">Prima tecnica salarial</option>
                    <option value="prima tecnica no salarial">Prima tecnica no salarial</option>
                </select>
            </div>
        </div>
        <div class="contenedor-flex">
            <div class="contenedor-parametros">
                <label for="fechaPosesion"><strong>Fecha de posesión</strong></label><br>
                <input type="date" id="fechaPosesion" name="calendarioFechaPosesion">
            </div>
            <div class="contenedor-parametros">
                <label for="selectionNombramiento"><strong>Nombramiento</strong></label><br>
                <select id="selectionNombramiento">
                    <option>Seleccione un tipo de nombramiento</option>
                </select>
            </div>
        </div>
        <div class="contenedor-flex">
            <div class="contenedor-parametros">
                <label for="selectionDependencia"><strong>Dependencia</strong></label><br>
                <select id="selectionDependencia">
                    <option>Seleccione una dependencia</option>
                </select>
            </div>
            <div class="contenedor-parametros">
                <label for="selectionDenominacion"><strong>Denominación</strong></label><br>
                <select id="selectionDenominacion">
            </select>
        </div>
        </div>
        <div class="contenedor-flex">
            <div class="contenedor-parametros">
                <label for="selectionCodigo"><strong>Código</strong></label><br>
                <select id="selectionCodigo">
                </select>
            </div>
            <div class="contenedor-parametros">
                <label for="selectionGrado"><strong>Grado</strong></label><br>
                <select id="selectionGrado">
                </select>
            </div>
        </div>
        <br>
        <button id="guardar-usuario" class="boton-azul">Guardar</button>
        <div id="modal-confirmar-guardar-usuario" class="modal-confirmar">
            <div class="modal-confirmar-content-lista">
                <div class="modal-confirmar-header-guardar">
                    <h2>Confirmar Guardar Usuario</h2>
                </div>
                <div class="modal-confirmar-body">
                    <p><strong>¿Está seguro de guardar usuario con estos datos?</strong></p>
                    <ul id="lista-datos-confirmacion">
                        <!-- Aquí se mostrarán los datos ingresados -->
                    </ul>
                </div>
                <div class="modal-confirmar-footer">
                    <button id="confirmar-guardar" class="boton-azul">Confirmar</button>
                    <button id="cancelar-guardar" class="boton-rojo">Cancelar</button>
                </div>
            </div>
        </div>
    </main>
    <script src="assets/js/script-modulo-agregar-usuario.js"></script>
</body>
</html>