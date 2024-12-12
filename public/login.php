<?php
include '../config/conexion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <h1>Inicio de Sesión</h1>
    <?php
    if (isset($_GET['error'])) {
        echo '<p style="color: red;">' . htmlspecialchars($_GET['error']) . '</p>';
    }
    if (isset($_GET['message'])) {
        echo '<p style="color: green;">' . htmlspecialchars($_GET['message']) . '</p>';
    }
    ?>
    <form action="login_process.php" method="post">
        <label for="username">Nombre de Usuario:</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Iniciar Sesión</button>
    </form>
</body>
</html>
