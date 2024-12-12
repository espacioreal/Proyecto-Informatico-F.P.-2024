// Funciones para validar formularios

// Al cargar la página
document.addEventListener('DOMContentLoaded', function() {
    console.log('Validación de formularios activada');

    // Validación de formulario de registro
    const form = document.getElementById('registerForm');
    if (form) {
        form.addEventListener('submit', function(event) {
            if (!validateRegisterForm()) {
                event.preventDefault();
                alert('Por favor, corrige los errores en el formulario.');
            }
        });
    }
});

// Ejemplo: Función para validar el formulario de registro
function validateRegisterForm() {
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    // Añadir más validaciones según sea necesario

    if (username === '' || password === '') {
        return false;
    }
    return true;
}
