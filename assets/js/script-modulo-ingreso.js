document.addEventListener("DOMContentLoaded", function() {
    setTimeout(function() {
        var errorMessage = document.getElementById('error-message-modulo-ingreso');
        if (errorMessage) {
            errorMessage.style.display = 'none';
        }
    }, 4000);
});