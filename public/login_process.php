<?php
include '../config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitización y validación de entradas
    function validate($data) {
        return htmlspecialchars(trim($data));
    }

    $Usuario = validate($_POST['username']);
    $Clave = validate($_POST['password']);

    // Verificar que no haya campos vacíos
    if (empty($Usuario) || empty($Clave)) {
        header("Location: login.php?error=Todos los campos son obligatorios.");
        exit;
    }

    // Verificar las credenciales del usuario
    $sql = "SELECT * FROM usuarios WHERE nombre = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $Usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if (password_verify($Clave, $row['contraseña'])) {
            // Iniciar sesión y redirigir al usuario
            session_start();
            $_SESSION['usuario'] = $row['nombre'];
            $_SESSION['rol'] = $row['rol_id'];
            header("Location: index.php");
            exit;
        } else {
            header("Location: login.php?error=Contraseña incorrecta.");
            exit;
        }
    } else {
        header("Location: login.php?error=Nombre de usuario no encontrado.");
        exit;
    }

    $stmt->close();
}
?>
