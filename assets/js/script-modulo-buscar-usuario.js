document.getElementById('menu-icon').addEventListener('click', function() {
    var dropdownMenu = document.getElementById('dropdown-menu');
    dropdownMenu.classList.toggle('show');
});

document.getElementById('logout-button').addEventListener('click', function() {
    window.location.href = '/php/main-page/cerrar-sesion.php'; 
});

document.addEventListener("DOMContentLoaded", function() {
    var btnBuscarUsuario = document.getElementById("buscar-usuario");
    var btnLimpiarDatos = document.getElementById("Limpiar-datos");
    var inputDocumento = document.getElementById("input-documento-buscar-usuarios");
    var selectCargo = document.getElementById("CargoSelectionUsuarios");
    var inputPrimerNombre = document.getElementById("input-primer-nombre-buscar-usuarios");
    var inputSegundoNombre = document.getElementById("input-segundo-nombre-buscar-usuarios");
    var inputPrimerApellido = document.getElementById("input-primer-apellido-buscar-usuarios");
    var inputSegundoApellido = document.getElementById("input-segundo-apellido-buscar-usuarios");
    var tablaUsuarios = document.getElementById("tabla-de-buscar-usuarios").getElementsByTagName("tbody")[0];

    btnBuscarUsuario.disabled = true;

    function habilitarBotonBuscar() {
        if(inputDocumento.value.trim() === "" && selectCargo.selectedIndex === 0 && inputPrimerNombre.value.trim() === "" && inputSegundoNombre.value.trim() === "" && inputPrimerApellido.value.trim() === "" && inputSegundoApellido.value.trim() === ""){
            btnBuscarUsuario.disabled = true;
        } else {
            btnBuscarUsuario.disabled = false;
        }
    }

    inputDocumento.addEventListener("input", habilitarBotonBuscar);
    selectCargo.addEventListener("change", habilitarBotonBuscar);
    inputPrimerNombre.addEventListener("input", habilitarBotonBuscar);
    inputSegundoNombre.addEventListener("input", habilitarBotonBuscar);
    inputPrimerApellido.addEventListener("input", habilitarBotonBuscar);
    inputSegundoApellido.addEventListener("input", habilitarBotonBuscar);

    btnBuscarUsuario.addEventListener("click", function() {
        var datosBusqueda = {
            documento: inputDocumento.value.trim(),
            cargo: selectCargo.value,
            primerNombre: inputPrimerNombre.value.trim(),
            segundoNombre: inputSegundoNombre.value.trim(),
            primerApellido: inputPrimerApellido.value.trim(),
            segundoApellido: inputSegundoApellido.value.trim()
        };

        // Realizar la solicitud AJAX
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "php/modulo-buscar-usuario/buscar-usuario.php", true);
        xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    try {
                        var resultados = JSON.parse(xhr.responseText);
                        if (resultados.error) {
                            console.error("Error en la respuesta:", resultados.error);
                            return;
                        }
                        tablaUsuarios.innerHTML = "";
                        resultados.forEach(function(usuario) {
                            var fila = tablaUsuarios.insertRow();
                            fila.insertCell(0).innerText = usuario.apellidos;
                            fila.insertCell(1).innerText = usuario.nombres;
                            fila.insertCell(2).innerText = usuario.numero_documento;
                            fila.insertCell(3).innerText = usuario.fecha_vinculacion;
                            fila.insertCell(4).innerText = usuario.cargo;
                            var estadoCell = fila.insertCell(5);
                            estadoCell.innerText = usuario.estado;
                            estadoCell.classList.add(usuario.estado === 'Activo' ? 'estado-activo' : 'estado-inactivo');
                            var opcionesCell = fila.insertCell(6);

                            // Agregar los íconos de opciones con diferentes imágenes
                            var acciones = [
                                {accion: "informacion", icono: "informacion.png"},
                                {accion: "editar", icono: "editar.png"},
                                {accion: "cambiar", icono: "cambiar.png"},
                                {accion: "eliminar", icono: "eliminar.png"}
                            ];

                            acciones.forEach(function(accionObj) {
                                var img = document.createElement("img");
                                img.src = "assets/iconos/" + accionObj.icono; // Cambiar por la ruta correcta de los iconos
                                img.classList.add("icono-opcion");
                                img.dataset.documento = usuario.numero_documento;
                                img.dataset.accion = accionObj.accion;
                                img.addEventListener("click", function() {
                                    realizarAccion(accionObj.accion, usuario.numero_documento);
                                });
                                opcionesCell.appendChild(img);
                            });
                        });
                    } catch (e) {
                        console.error("Error parsing JSON:", e);
                    }
                } else {
                    console.error("Error en la solicitud:", xhr.statusText);
                }
            }
        };
        xhr.send(JSON.stringify(datosBusqueda));
    });

    btnLimpiarDatos.addEventListener("click", function() {
        inputDocumento.value = "";
        selectCargo.selectedIndex = "0";
        inputPrimerNombre.value = "";
        inputSegundoNombre.value = "";
        inputPrimerApellido.value = "";
        inputSegundoApellido.value = "";
        habilitarBotonBuscar();
    });

    function realizarAccion(accion, documento) {
        // Lógica para manejar las diferentes acciones
        console.log("Acción:", accion, "Documento:", documento);
        // Aquí se puede redirigir a diferentes páginas o realizar diferentes acciones basadas en el "accion" y "documento"
    }
});
