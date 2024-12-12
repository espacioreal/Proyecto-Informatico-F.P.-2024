<?php
include '../config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitización y validación de entradas
    function validate($data) {
        return htmlspecialchars(trim($data));
    }

    $Usuario = validate($_POST['usuario']);
    $Clave = validate($_POST['clave']);
    $rol = isset($_POST['rol_id']) ? intval($_POST['rol_id']) : 2; // 2 = Rol de usuario regular por defecto

    // Verificar que no haya campos vacíos
    if (empty($Usuario) || empty($Clave)) {
        header("Location: register.php?error=Todos los campos son obligatorios.");
        exit;
    }

    // Verificar si el usuario ya existe
    $sql_usuario = "SELECT * FROM usuarios WHERE nombre = ?";
    $stmt = $conn->prepare($sql_usuario);
    $stmt->bind_param("s", $Usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        header("Location: register.php?error=El nombre de usuario ya está registrado.");
        exit;
    }

    // Cifrar la contraseña
    $hashedPassword = password_hash($Clave, PASSWORD_DEFAULT);

    // Insertar el usuario en la base de datos
    $sql = "INSERT INTO usuarios (nombre, contraseña, rol_id) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $Usuario, $hashedPassword, $rol);

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
