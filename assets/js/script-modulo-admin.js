document.getElementById('menu-icon').addEventListener('click', function() {
    var dropdownMenu = document.getElementById('dropdown-menu');
    dropdownMenu.classList.toggle('show');
});

document.getElementById('logout-button').addEventListener('click', function() {
    window.location.href = '/php/main-page/cerrar-sesion.php'; 
});

document.getElementById('container-buscar-usuario').addEventListener('click', function() {
    window.location.href = '/modulo-buscar-usuario.php';
});

document.getElementById('container-agregar-usuario').addEventListener('click', function() {
    window.location.href = '/modulo-agregar-usuario.php';
});

document.getElementById('container-administrar-nombramientos').addEventListener('click', function() {
    window.location.href = '/modulo-administrar-nombramientos.php';
});

document.getElementById('container-administrar-dependencias').addEventListener('click', function() {
    window.location.href = '/modulo-administrar-dependencias.php';
});

document.getElementById('container-administrar-denominacion-codigo-grado').addEventListener('click', function(){
    window.location.href = '/modulo-administrar-denominacion-codigo-grado.php';
});