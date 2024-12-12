<?php
include '../config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitización y validación de entradas
    function validate($data) {
        return htmlspecialchars(trim($data));
    }

    $Usuario = validate($_POST['usuario']);
    $Email = validate($_POST['email']);
    $Clave = validate($_POST['clave']);
    $rol = isset($_POST['rol_id']) ? intval($_POST['rol_id']) : 2; // 2 = Rol de usuario regular por defecto

    // Verificar que no haya campos vacíos
    if (empty($Usuario) || empty($Email) || empty($Clave)) {
        header("Location: register.php?error=Todos los campos son obligatorios.");
        exit;
    }

    // Verificar si el usuario o el correo electrónico ya existen
    $sql_usuario = "SELECT * FROM usuarios WHERE nombre = ? OR email = ?";
    $stmt = $conn->prepare($sql_usuario);
    $stmt->bind_param("ss", $Usuario, $Email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        header("Location: register.php?error=El nombre de usuario o el correo electrónico ya están registrados.");
        exit;
    }

    // Cifrar la contraseña
    $hashedPassword = password_hash($Clave, PASSWORD_DEFAULT);

    // Insertar el usuario en la base de datos
    $sql = "INSERT INTO usuarios (nombre, email, contraseña, rol_id) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $Usuario, $Email, $hashedPassword, $rol);

    if ($stmt->execute()) {
        header("Location: login.php?message=Registro exitoso. Por favor, inicia sesión.");
        exit;
    } else {
        header("Location: register.php?error=Error al registrar el usuario. Por favor, intenta nuevamente.");
        exit;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../public/css/style.css"> <!-- Verifica la ruta del CSS -->
</head>
<body>
    <h1>Registro de Usuario</h1>
    <?php
    if (isset($_GET['error'])) {
        echo '<p style="color: red;">' . htmlspecialchars($_GET['error']) . '</p>';
    }
    ?>
    <form action="register.php" method="post">
        <label for="usuario">Nombre de Usuario:</label>
        <input type="text" id="usuario" name="usuario" required>
        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email" required>
        <label for="clave">Contraseña:</label>
        <input type="password" id="clave" name="clave" required>
        <button type="submit">Registrarse</button>
    </form>
</body>
</html>
