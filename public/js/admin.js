// Funciones específicas para el área de administración

// Al cargar la página del admin
document.addEventListener('DOMContentLoaded', function() {
    console.log('Admin Página cargada');
    // Aquí puedes añadir más funcionalidades que se ejecuten al cargar la página del admin
});

// Ejemplo: Función para confirmar la eliminación de un usuario
function confirmDelete(userId) {
    if (confirm('¿Estás seguro de que deseas eliminar este usuario?')) {
        // Aquí agregar la lógica para eliminar el usuario
        console.log('Usuario ' + userId + ' eliminado');
    }
}
