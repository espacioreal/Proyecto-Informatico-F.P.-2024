<?php
// Iniciar la sesión
session_start();

// Eliminar todas las variables de sesión
session_unset();

// Destruir la sesión
session_destroy();

// Redirigir al usuario a la página de inicio de sesión con un mensaje opcional
header("Location: login.php?message=Sesión cerrada exitosamente");
exit();
