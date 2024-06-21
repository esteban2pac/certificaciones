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
    var tablaNombramientos = document.getElementById("tabla-nombramientos");
    tablaNombramientos.addEventListener("click", function(event) {
        var target = event.target;
        if (target.classList.contains("blue-button") || target.classList.contains("icon")) {
            var boton = target.closest(".blue-button"); 
            var idNombramiento = boton.getAttribute('data-id');
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "php/modulo-administrar-nombramiento/obtener-nombramiento.php?id=" + idNombramiento, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var datosNombramiento = JSON.parse(xhr.responseText);
                    document.getElementById("input-tipo-nombramiento-editar").value = datosNombramiento.tipo;
                    document.getElementById("viejo-id").value = datosNombramiento.id;
                }
            };
            xhr.send();
            document.querySelector(".innerbox-nombramientos").style.display = "none";
            document.querySelector(".innerbox-nombramientos-editar").style.display = "block";
        }
        if (target.classList.contains("boton-azul-estado") || target.classList.contains("icono-estado")) {
            var botonCambiarestado = target.closest(".boton-azul-estado"); 
            var nombramientoId = botonCambiarestado.dataset.id;
            modalCambiarestado.style.display = "block";
        }
        btnCancelarCambiarestado.onclick = function() {
            modalCambiarestado.style.display = "none";
        }
        btnConfirmarCambiarestado.onclick = function() {
            cambiarestadoNombramiento(nombramientoId);
        }
    });

    function cambiarestadoNombramiento(nombramientoId) {
        var xhr = new XMLHttpRequest();
        var url = "php/modulo-administrar-nombramiento/cambiar-estado-nombramiento.php";
        var datos = "id=" + encodeURIComponent(nombramientoId);
        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    cargarNombramientos(paginaActual);
                    actualizarBotones();
                    modalCambiarestado.style.display = "none";
                } else {
                    console.error("Error al cambiar el estado de nombramiento.");
                }
            }
        };
        xhr.send(datos);
    }

    document.getElementById("cancelar-editar-nombramiento").addEventListener("click", function() {
        document.querySelector(".innerbox-nombramientos").style.display = "block";
        document.querySelector(".innerbox-nombramientos-editar").style.display = "none";
        document.getElementById("input-tipo-nombramiento-editar").value = "";
    });

    var inputBusqueda = document.getElementById("busqueda-nombramientos");
    var paginaActual = 1;
    var totalPaginas = 1;
    var totalRegistros = 0; 
    var por_pagina = 7; 

    function cargarNombramientos(pagina) {
        var xhr = new XMLHttpRequest();
        var url = "php/modulo-administrar-nombramiento/buscar-nombramientos.php?pagina=" + pagina + "&busqueda=" + encodeURIComponent(inputBusqueda.value);
        xhr.open("GET", url, true);
        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var response = JSON.parse(xhr.responseText);
                var tbody = document.querySelector("#tabla-nombramientos tbody");
                tbody.innerHTML = "";
                    if (response.hasOwnProperty("nombramientos") && response.nombramientos.length > 0) {
                        response.nombramientos.forEach(function(nombramiento) {
                            var row = "<tr>";
                            row += "<td colspan='2'>" + nombramiento.tipo + "</td>";
                            row += "<td>" + (nombramiento.estado ? "<span style='color:green;'>Activo</span>" : "<span style='color:red;'>Inactivo</span>") + "</td>";
                            row += "<td>";
                            row += "<button class='blue-button' id='editar-nombramiento' data-id='" + nombramiento.id + "'><img src='assets/iconos/editar-dato.png' title='Editar' class='icon'></button>";
                            row += "<button class='boton-azul-estado' id='cambiar-estado' data-id='" + nombramiento.id + "'><img src='assets/iconos/cambiar.png' title='Cambiar estado' class='icono-estado'></button>";
                            row += "</td>";
                            row += "</tr>";
                            tbody.innerHTML += row;
                        });
                        totalPaginas = response.total_paginas;
                        totalRegistros = response.total_registros;
                        actualizarBotones(); 
                    } else {
                        var mensaje = "<tr><td colspan='5'>No hay nombramientos registrados con ese tipo</td></tr>";
                        tbody.innerHTML = mensaje;
                    }
                }
            };
        xhr.send();
    }
    function actualizarBotones() {
        if (paginaActual === 1) {
            document.getElementById("anterior-nombramientos").disabled = true;
        } else {
            document.getElementById("anterior-nombramientos").disabled = false;
        }
        if (!haySiguientePagina()) {
            document.getElementById("siguiente-nombramientos").disabled = true;
        } else {
            document.getElementById("siguiente-nombramientos").disabled = false;
        }
    
        var botonPagina = document.getElementById("boton-pagina-nombramientos");
        botonPagina.textContent = "Página " + paginaActual + " de " + totalPaginas;

        var rangoActual = (paginaActual - 1) * por_pagina + 1;
        var totalActual = rangoActual + document.querySelectorAll("#tabla-nombramientos tbody tr").length - 1;
        document.getElementById("rango-actual").textContent = rangoActual;
        document.getElementById("total-actual").textContent = totalActual;
        document.getElementById("total-bd").textContent = totalRegistros;
    }

    function haySiguientePagina() {
        return paginaActual < totalPaginas;
    }

    inputBusqueda.addEventListener("input", function() {
        cargarNombramientos(paginaActual);
        actualizarBotones();
    });

    document.getElementById("anterior-nombramientos").addEventListener("click", function() {
        if (paginaActual > 1) {
            paginaActual--;
            cargarNombramientos(paginaActual);
            actualizarBotones();
        }
    });

    document.getElementById("siguiente-nombramientos").addEventListener("click", function() {
        paginaActual++;
        cargarNombramientos(paginaActual);
        actualizarBotones();
    });

    cargarNombramientos(paginaActual);
    var xhr = new XMLHttpRequest();
    var url = "php/modulo-administrar-nombramiento/buscar-nombramientos.php?pagina=1&busqueda=" + encodeURIComponent(inputBusqueda.value);
    xhr.open("GET", url, true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            totalPaginas = JSON.parse(xhr.responseText).total_paginas;
            actualizarBotones();
        }
    };
    xhr.send();

    var botonEliminarNombramiento = document.getElementById("confirmar-btn-eliminar");
    botonEliminarNombramiento.addEventListener("click", function() {
        var idNombramiento = document.getElementById("viejo-id").value;
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "php/modulo-administrar-nombramiento/eliminar-nombramiento.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                var messageContainer;
                if (response.success) {
                    messageContainer = document.getElementById("success-message-eliminar-nombramientos");
                    if (!messageContainer) {
                        messageContainer = document.createElement("div");
                        messageContainer.id = "success-message-eliminar-nombramientos";
                        messageContainer.className = "success-message";
                        document.querySelector(".innerbox-nombramientos").appendChild(messageContainer);
                    }
                    messageContainer.textContent = response.message;
                } else {
                    messageContainer = document.getElementById("error-message-eliminar-nombramientos");
                    if (!messageContainer) {
                        messageContainer = document.createElement("div");
                        messageContainer.id = "error-message-eliminar-nombramientos";
                        messageContainer.className = "error-message";
                        document.querySelector(".innerbox-nombramientos").appendChild(messageContainer);
                    }
                    messageContainer.textContent = response.message;
                }
                modalEliminar.style.display = "none";
                cargarNombramientos(paginaActual);
                actualizarBotones();
                setTimeout(function() {
                    var errorMessageNombramientosEliminar = document.getElementById('error-message-eliminar-nombramientos');
                    var succesMessageNombramientosEliminar = document.getElementById('success-message-eliminar-nombramientos')
                    if (errorMessageNombramientosEliminar) {
                      errorMessageNombramientosEliminar.style.display = 'none';
                    }
                    if (succesMessageNombramientosEliminar){
                      succesMessageNombramientosEliminar.style.display = 'none';
                    }
                  }, 3000);
                document.querySelector(".innerbox-nombramientos").style.display = "block";
                document.querySelector(".innerbox-nombramientos-editar").style.display = "none";
                document.getElementById("input-tipo-nombramiento-editar").value = "";
            }
        };
        var data = "id-nombramiento=" + encodeURIComponent(idNombramiento);
        xhr.send(data);
    });

});

document.addEventListener("DOMContentLoaded", function() {
  setTimeout(function() {
    var errorMessageNombramientos = document.getElementById('error-message-main-nombramientos');
    var succesMessageNombramientos = document.getElementById('success-message-main-nombramientos')
    if (errorMessageNombramientos) {
      errorMessageNombramientos.style.display = 'none';
    }
    if (succesMessageNombramientos){
      succesMessageNombramientos.style.display = 'none';
    }
  }, 3000);
});
document.addEventListener("DOMContentLoaded", function(){
  setTimeout(function() {
    var errorMessageNombramientosEditar = document.getElementById('error-message-editar-nombramientos');
    var succesMessageNombramientosEditar = document.getElementById('success-message-editar-nombramientos')
    if (errorMessageNombramientosEditar) {
      errorMessageNombramientosEditar.style.display = 'none';
    }
    if (succesMessageNombramientosEditar){
      succesMessageNombramientosEditar.style.display = 'none';
    }
  }, 3000);
});

var modalEliminar = document.getElementById("modal-confirmar-eliminar");
var btnAbrirModalEliminar = document.getElementById("eliminar-nombramiento");
var btnCancelarEliminar = document.getElementById("cancelar-btn-eliminar");

btnAbrirModalEliminar.onclick = function() {
  modalEliminar.style.display = "block";
}

btnCancelarEliminar.onclick = function() {
  modalEliminar.style.display = "none";
}
