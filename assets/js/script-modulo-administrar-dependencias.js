document.getElementById('menu-icon').addEventListener('click', function() {
    var dropdownMenu = document.getElementById('dropdown-menu');
    dropdownMenu.classList.toggle('show');
});

document.getElementById('logout-button').addEventListener('click', function() {
    window.location.href = '/php/main-page/cerrar-sesion.php'; 
});

var modalCambiarestado = document.getElementById("modal-confirmar-cambiar-estado");
var btnCancelarCambiarestado = document.getElementById("cancelar-btn-cambiar-estado");
var btnConfirmarCambiarestado = document.getElementById("confirmar-btn-cambiar-estado");

document.addEventListener("DOMContentLoaded", function() {
    var tabladependencias = document.getElementById("tabla-dependencias");
    tabladependencias.addEventListener("click", function(event) {
        var target = event.target;
        if (target.classList.contains("blue-button") || target.classList.contains("icon")) {
            var boton = target.closest(".blue-button"); 
            var iddependencia = boton.getAttribute('data-id');
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "php/modulo-administrar-dependencia/obtener-dependencia.php?id=" + iddependencia, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var datosdependencia = JSON.parse(xhr.responseText);
                    document.getElementById("input-nombre-dependencia-editar").value = datosdependencia.nombre;
                    document.getElementById("viejo-id").value = datosdependencia.id;
                }
            };
            xhr.send();
            document.querySelector(".innerbox-dependencias").style.display = "none";
            document.querySelector(".innerbox-dependencias-editar").style.display = "block";
        }
        if (target.classList.contains("boton-azul-estado") || target.classList.contains("icono-estado")) {
            var botonCambiarestado = target.closest(".boton-azul-estado"); 
            var dependenciaId = botonCambiarestado.dataset.id;
            modalCambiarestado.style.display = "block";
        }
        btnCancelarCambiarestado.onclick = function() {
            modalCambiarestado.style.display = "none";
        }
        btnConfirmarCambiarestado.onclick = function() {
            cambiarestadodependencia(dependenciaId);
        }
    });

    function cambiarestadodependencia(dependenciaId) {
        var xhr = new XMLHttpRequest();
        var url = "php/modulo-administrar-dependencia/cambiar-estado-dependencia.php";
        var datos = "id=" + encodeURIComponent(dependenciaId);
        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    cargardependencias(paginaActual);
                    actualizarBotones();
                    modalCambiarestado.style.display = "none";
                } else {
                    console.error("Error al cambiar el estado de dependencia.");
                }
            }
        };
        xhr.send(datos);
    }

    document.getElementById("cancelar-editar-dependencia").addEventListener("click", function() {
        document.querySelector(".innerbox-dependencias").style.display = "block";
        document.querySelector(".innerbox-dependencias-editar").style.display = "none";
        document.getElementById("input-nombre-dependencia-editar").value = "";
    });

    var inputBusqueda = document.getElementById("busqueda-dependencias");
    var paginaActual = 1;
    var totalPaginas = 1;
    var totalRegistros = 0; 
    var por_pagina = 7; 

    function cargardependencias(pagina) {
        var xhr = new XMLHttpRequest();
        var url = "php/modulo-administrar-dependencia/buscar-dependencias.php?pagina=" + pagina + "&busqueda=" + encodeURIComponent(inputBusqueda.value);
        xhr.open("GET", url, true);
        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var response = JSON.parse(xhr.responseText);
                var tbody = document.querySelector("#tabla-dependencias tbody");
                tbody.innerHTML = "";
                    if (response.hasOwnProperty("dependencias") && response.dependencias.length > 0) {
                        response.dependencias.forEach(function(dependencia) {
                            var row = "<tr>";
                            row += "<td colspan='2'>" + dependencia.nombre + "</td>";
                            row += "<td>" + (dependencia.estado ? "<span style='color:green;'>Activo</span>" : "<span style='color:red;'>Inactivo</span>") + "</td>";
                            row += "<td>";
                            row += "<button class='blue-button' id='editar-dependencia' data-id='" + dependencia.id + "'><img src='assets/iconos/editar-dato.png' title='Editar' class='icon'></button>";
                            row += "<button class='boton-azul-estado' id='cambiar-estado' data-id='" + dependencia.id + "'><img src='assets/iconos/cambiar.png' title='Cambiar estado' class='icono-estado'></button>";
                            row += "</td>";
                            row += "</tr>";
                            tbody.innerHTML += row;
                        });
                        totalPaginas = response.total_paginas;
                        totalRegistros = response.total_registros;
                        actualizarBotones(); 
                    } else {
                        var mensaje = "<tr><td colspan='5'>No hay dependencias registrados con ese nombre</td></tr>";
                        tbody.innerHTML = mensaje;
                    }
                }
            };
        xhr.send();
    }
    function actualizarBotones() {
        if (paginaActual === 1) {
            document.getElementById("anterior-dependencias").disabled = true;
        } else {
            document.getElementById("anterior-dependencias").disabled = false;
        }
        if (!haySiguientePagina()) {
            document.getElementById("siguiente-dependencias").disabled = true;
        } else {
            document.getElementById("siguiente-dependencias").disabled = false;
        }
    
        var botonPagina = document.getElementById("boton-pagina-dependencias");
        botonPagina.textContent = "Página " + paginaActual + " de " + totalPaginas;

        var rangoActual = (paginaActual - 1) * por_pagina + 1;
        var totalActual = rangoActual + document.querySelectorAll("#tabla-dependencias tbody tr").length - 1;
        document.getElementById("rango-actual").textContent = rangoActual;
        document.getElementById("total-actual").textContent = totalActual;
        document.getElementById("total-bd").textContent = totalRegistros;
    }

    function haySiguientePagina() {
        return paginaActual < totalPaginas;
    }

    inputBusqueda.addEventListener("input", function() {
        cargardependencias(paginaActual);
        actualizarBotones();
    });

    document.getElementById("anterior-dependencias").addEventListener("click", function() {
        if (paginaActual > 1) {
            paginaActual--;
            cargardependencias(paginaActual);
            actualizarBotones();
        }
    });

    document.getElementById("siguiente-dependencias").addEventListener("click", function() {
        paginaActual++;
        cargardependencias(paginaActual);
        actualizarBotones();
    });

    cargardependencias(paginaActual);
    var xhr = new XMLHttpRequest();
    var url = "php/modulo-administrar-dependencia/buscar-dependencias.php?pagina=1&busqueda=" + encodeURIComponent(inputBusqueda.value);
    xhr.open("GET", url, true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            totalPaginas = JSON.parse(xhr.responseText).total_paginas;
            actualizarBotones();
        }
    };
    xhr.send();

    var botonEliminardependencia = document.getElementById("confirmar-btn-eliminar");
    botonEliminardependencia.addEventListener("click", function() {
        var iddependencia = document.getElementById("viejo-id").value;
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "php/modulo-administrar-dependencia/eliminar-dependencia.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                var messageContainer;
                if (response.success) {
                    messageContainer = document.getElementById("success-message-eliminar-dependencias");
                    if (!messageContainer) {
                        messageContainer = document.createElement("div");
                        messageContainer.id = "success-message-eliminar-dependencias";
                        messageContainer.className = "success-message";
                        document.querySelector(".innerbox-dependencias").appendChild(messageContainer);
                    }
                    messageContainer.textContent = response.message;
                } else {
                    messageContainer = document.getElementById("error-message-eliminar-dependencias");
                    if (!messageContainer) {
                        messageContainer = document.createElement("div");
                        messageContainer.id = "error-message-eliminar-dependencias";
                        messageContainer.className = "error-message";
                        document.querySelector(".innerbox-dependencias").appendChild(messageContainer);
                    }
                    messageContainer.textContent = response.message;
                }
                modalEliminar.style.display = "none";
                cargardependencias(paginaActual);
                actualizarBotones();
                setTimeout(function() {
                    var errorMessagedependenciasEliminar = document.getElementById('error-message-eliminar-dependencias');
                    var succesMessagedependenciasEliminar = document.getElementById('success-message-eliminar-dependencias')
                    if (errorMessagedependenciasEliminar) {
                      errorMessagedependenciasEliminar.style.display = 'none';
                    }
                    if (succesMessagedependenciasEliminar){
                      succesMessagedependenciasEliminar.style.display = 'none';
                    }
                  }, 3000);
                document.querySelector(".innerbox-dependencias").style.display = "block";
                document.querySelector(".innerbox-dependencias-editar").style.display = "none";
                document.getElementById("input-nombre-dependencia-editar").value = "";
            }
        };
        var data = "id-dependencia=" + encodeURIComponent(iddependencia);
        xhr.send(data);
    });

});

document.addEventListener("DOMContentLoaded", function() {
  setTimeout(function() {
    var errorMessagedependencias = document.getElementById('error-message-main-dependencias');
    var succesMessagedependencias = document.getElementById('success-message-main-dependencias')
    if (errorMessagedependencias) {
      errorMessagedependencias.style.display = 'none';
    }
    if (succesMessagedependencias){
      succesMessagedependencias.style.display = 'none';
    }
  }, 3000);
});
document.addEventListener("DOMContentLoaded", function(){
  setTimeout(function() {
    var errorMessagedependenciasEditar = document.getElementById('error-message-editar-dependencias');
    var succesMessagedependenciasEditar = document.getElementById('success-message-editar-dependencias')
    if (errorMessagedependenciasEditar) {
      errorMessagedependenciasEditar.style.display = 'none';
    }
    if (succesMessagedependenciasEditar){
      succesMessagedependenciasEditar.style.display = 'none';
    }
  }, 3000);
});

var modalEliminar = document.getElementById("modal-confirmar-eliminar");
var btnAbrirModalEliminar = document.getElementById("eliminar-dependencia");
var btnCancelarEliminar = document.getElementById("cancelar-btn-eliminar");

btnAbrirModalEliminar.onclick = function() {
  modalEliminar.style.display = "block";
}

btnCancelarEliminar.onclick = function() {
  modalEliminar.style.display = "none";
}
