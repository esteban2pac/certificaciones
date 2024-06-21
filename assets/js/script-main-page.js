document.getElementById('menu-icon').addEventListener('click', function() {
    var dropdownMenu = document.getElementById('dropdown-menu');
    dropdownMenu.classList.toggle('show');
});

document.getElementById('logout-button').addEventListener('click', function() {
    window.location.href = '/php/main-page/cerrar-sesion.php'; 
});


document.getElementById('container-certificado-sin-salario').addEventListener('click', function() {
    window.location.href = '/certificado-sin-salario.php';
});

document.getElementById('container-certificado-con-salario').addEventListener('click', function() {
    window.location.href = '/certificado-con-salario.php';
});