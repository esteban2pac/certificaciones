document.getElementById('menu-icon').addEventListener('click', function() {
    var dropdownMenu = document.getElementById('dropdown-menu');
    dropdownMenu.classList.toggle('show');
});

document.getElementById('logout-button').addEventListener('click', function() {
    window.location.href = '/php/main-page/cerrar-sesion.php'; 
});

document.addEventListener("DOMContentLoaded", function() {
    let denominaciones = [];
    let codigos = [];
    let grados = [];
    let nombramientos = [];
    let dependencias = [];    
    function loadDenominaciones() {
        const selectDenominacion = document.getElementById('selectionDenominacion');
        denominaciones.forEach(denom => {
            const option = document.createElement('option');
            option.value = denom.id;
            option.textContent = denom.nombre;
            selectDenominacion.appendChild(option);
        });
    }
    function loadCodigos(denominacionId) {
        const selectCodigo = document.getElementById('selectionCodigo');
        codigos.filter(cod => cod.denominacion_id == denominacionId).forEach(cod => {
            const option = document.createElement('option');
            option.value = cod.id;
            option.textContent = cod.codigo;
            selectCodigo.appendChild(option);
        });
        selectCodigo.selectedIndex = 0;
        selectCodigo.dispatchEvent(new Event('change'));
    }
    function loadGrados(codigoId) {
        const selectGrado = document.getElementById('selectionGrado');
        grados.filter(grado => grado.codigo_id == codigoId).forEach(grado => {
            const option = document.createElement('option');
            option.value = grado.id;
            option.textContent = grado.grado;
            selectGrado.appendChild(option);
        });
        selectGrado.selectedIndex = 0;
    }
    function loadNombramientos() {
        const selectNombramiento = document.getElementById('selectionNombramiento');
        nombramientos.forEach(nombr => {
            const option = document.createElement('option');
            option.value = nombr.id;
            option.textContent = nombr.tipo;
            selectNombramiento.appendChild(option);
        });
    }
    function loadDependencias() {
        const selectDependencia = document.getElementById('selectionDependencia');
        dependencias.forEach(dep => {
            const option = document.createElement('option');
            option.value = dep.id;
            option.textContent = dep.nombre;
            selectDependencia.appendChild(option);
        });
    }
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "php/modulo-agregar-usuario/obtener-denominaciones-codigos-grados.php", true);
    xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            try {
                var data = JSON.parse(xhr.responseText);
                if (data.error) {
                    console.error("Error en la respuesta:", data.error);
                    return;
                }
                denominaciones = data.denominaciones;
                codigos = data.codigos;
                grados = data.grados;
                loadDenominaciones();
            } catch (e) {
                console.error("Error parsing JSON:", e);
            }
        } else if (xhr.readyState === 4) {
            console.error("Error en la solicitud:", xhr.statusText);
        }
    };
    xhr.send();
    var xhrNombramientos = new XMLHttpRequest();
    xhrNombramientos.open("POST", "php/modulo-agregar-usuario/obtener-nombramiento.php", true);
    xhrNombramientos.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    xhrNombramientos.onreadystatechange = function() {
        if (xhrNombramientos.readyState === 4 && xhrNombramientos.status === 200) {
            try {
                var data = JSON.parse(xhrNombramientos.responseText);
                if (data.error) {
                    console.error("Error en la respuesta:", data.error);
                    return;
                }
                nombramientos = data.nombramientos;
                loadNombramientos();
            } catch (e) {
                console.error("Error parsing JSON:", e);
            }
        } else if (xhrNombramientos.readyState === 4) {
            console.error("Error en la solicitud:", xhrNombramientos.statusText);
        }
    };
    xhrNombramientos.send();
    var xhrDependencias = new XMLHttpRequest();
    xhrDependencias.open("POST", "php/modulo-agregar-usuario/obtener-dependencia.php", true);
    xhrDependencias.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    xhrDependencias.onreadystatechange = function() {
        if (xhrDependencias.readyState === 4 && xhrDependencias.status === 200) {
            try {
                var data = JSON.parse(xhrDependencias.responseText);
                if (data.error) {
                    console.error("Error en la respuesta:", data.error);
                    return;
                }
                dependencias = data.dependencias;
                loadDependencias();
            } catch (e) {
                console.error("Error parsing JSON:", e);
            }
        } else if (xhrDependencias.readyState === 4) {
            console.error("Error en la solicitud:", xhrDependencias.statusText);
        }
    };
    xhrDependencias.send();
    document.getElementById('selectionGrado').innerHTML = '<option value="Seleccione grado empleo">Seleccione grado empleo</option>';
    document.getElementById('selectionCodigo').innerHTML = '<option value="">Seleccione código empleo</option>';
    document.getElementById('selectionDenominacion').addEventListener('change', function() {
        const denominacionId = this.value;
        if (denominacionId) {
            document.getElementById('selectionCodigo').innerHTML="";
            loadCodigos(denominacionId);
            document.getElementById('selectionCodigo').selectedIndex = 0;
            document.getElementById('selectionGrado').selectedIndex = 0;
        }
    });
    document.getElementById('selectionCodigo').addEventListener('change', function() {
        const codigoId = this.value;
        if (codigoId) {
            document.getElementById('selectionGrado').innerHTML="";
            loadGrados(codigoId);
            document.getElementById('selectionGrado').selectedIndex = 0;
        }
    });
});
document.getElementById('salarioUsuario').addEventListener('input', function (e) {
    let value = e.target.value;
    
    value = value.replace(/\D/g, '');
    
    value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    
    e.target.value = value;
});
document.addEventListener("DOMContentLoaded", function() {
    var inputFechaInicio = document.getElementById("fechaPosesion");
    var today = new Date();
    inputFechaInicio.max = today.toISOString().split('T')[0];
  });

document.addEventListener("DOMContentLoaded", function() {
    const botonGuardar = document.getElementById("guardar-usuario");
    botonGuardar.disabled = true;
    const formElements = [
        document.getElementById("documentoSelection"),
        document.getElementById("input-documento"),
        document.getElementById("generoSelection"),
        document.getElementById("input-primer-nombre"),
        document.getElementById("input-primer-apellido"),
        document.getElementById("input-segundo-apellido"),
        document.getElementById("salarioUsuario"),
        document.getElementById("selectionBonoSalarial"),
        document.getElementById("fechaPosesion"),
        document.getElementById("selectionNombramiento"),
        document.getElementById("selectionDependencia"),
        document.getElementById("selectionDenominacion"),
        document.getElementById("selectionCodigo"),
        document.getElementById("selectionGrado"),
    ];
  
    function isFormElementValid(element) {
        if (element === document.getElementById("selectionBonoSalarial")) {
        return element.value !== "Seleccione una opción";
        }
        return element.selectedIndex !== 0 && element.value.trim() !== "";
    }
  
    function isFormValid() {
        for (const element of formElements) {
        if (!isFormElementValid(element)) {
            return false;
        }
        }
        return true;
    }
  
    function HabilitarBotonGuardar() {
        if (isFormValid()) {
        botonGuardar.disabled = false;
        } else {
        botonGuardar.disabled = true;
        }
    }
  
    for (const element of formElements) {
        element.addEventListener("change", HabilitarBotonGuardar);
        if (element !== document.getElementById("selectionBonoSalarial")) {
            element.addEventListener("input", HabilitarBotonGuardar);
        }
    }
});
document.addEventListener("DOMContentLoaded", function() {
    var elementosFormulario = document.querySelectorAll('.contenedor-flex select, .contenedor-parametro-unico select, .contenedor-flex input[type="text"], .contenedor-flex input[type="number"] , .contenedor-flex input[type="date"], .contenedor-flex textarea,  .contenedor-parametro-unico input[type="date"], .contenedor-parametro-unico input[type="text"],  .contenedor-parametro-unico select,  .contenedor-parametro-unico textarea');
  
    elementosFormulario.forEach(function(elemento) {
      if (elemento.id !== 'input-segundo-nombre') { 
        // Crear mensaje de validación
        var mensajeValidacion = document.createElement('span');
        mensajeValidacion.className = 'mensaje-validacion';
        mensajeValidacion.style.color = 'red';
        mensajeValidacion.textContent = 'Este campo es requerido';
        mensajeValidacion.style.display = 'block';
  
        elemento.parentNode.appendChild(mensajeValidacion);
  
        elemento.addEventListener('input', function() {
          if (elemento.value.trim() === '' || elemento.selectedIndex === 0) {
            mensajeValidacion.style.display = 'block';
          } else {
            mensajeValidacion.style.display = 'none';
          }
        });
      }
    });
  });
var modalConfirmarGuardar = document.getElementById("modal-confirmar-guardar-usuario");
function mostrarConfirmacion() {
    modalConfirmarGuardar.style.display = "block"; 

    var listaDatosConfirmacion = document.getElementById("lista-datos-confirmacion");
    listaDatosConfirmacion.innerHTML = "";

    var elementosFormulario = document.querySelectorAll('.contenedor-flex select, .contenedor-flex input[type="text"], .contenedor-flex input[type="number"], .contenedor-flex input[type="date"], .contenedor-parametro-unico select');

    elementosFormulario.forEach(function (elemento) {
        if ((elemento.tagName === "SELECT" && elemento.selectedIndex !== 0) ||
            (elemento.tagName !== "SELECT" && elemento.value.trim() !== "")) {
                var label = elemento.closest(".contenedor-parametros, .contenedor-parametro-unico").querySelector("strong");
                var labelText = label ? "<strong>" + label.textContent.trim() + "</strong>" : "";
                var valorElemento = elemento.tagName === "SELECT" ? elemento.options[elemento.selectedIndex].text : elemento.value;
                var listItem = document.createElement("li");
                listItem.innerHTML = labelText + ": " + valorElemento;
                listaDatosConfirmacion.appendChild(listItem);
                listaDatosConfirmacion.appendChild(document.createElement("br"));
        }
    });
}

function ocultarModal() {
    modalConfirmarGuardar.scrollTo(0,0); 
    modalConfirmarGuardar.style.display = "none"; 
   
}

var btnGuardar = document.getElementById("guardar-usuario");
btnGuardar.addEventListener("click", mostrarConfirmacion);


document.getElementById("cancelar-guardar").addEventListener("click", ocultarModal);


document.getElementById("confirmar-guardar").addEventListener("click", function () {
    // Aquí puedes agregar la lógica para guardar el usuario
    console.log('Usuario guardado');
    ocultarModal(); // Ocultar el modal
});