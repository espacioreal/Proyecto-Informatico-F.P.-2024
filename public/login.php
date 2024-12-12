<?php
session_start();
include_once("../config/conexion.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Función para limpiar y validar datos de entrada
    function validate($data) {
        $data = trim($data);            // Elimina espacios en blanco al inicio y final
        $data = stripslashes($data);    // Elimina barras invertidas
        $data = htmlspecialchars($data); // Convierte caracteres especiales en entidades HTML
        return $data;
    }

    $usuario = validate($_POST['usuario']);
    $clave = validate($_POST['clave']);

    // Validación de campos requeridos
    if (empty($usuario) || empty($clave)) {
        $_SESSION['error'] = "El usuario y la clave son requeridos.";
        header("Location: ../views/login.php");
        exit();
    }

    try {
        // Consulta a la base de datos
        $sql = "SELECT * FROM usuarios WHERE nombre = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $result = $stmt->get_result();

        // Verifica si el usuario existe
        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();

            // Verifica la contraseña
            if (password_verify($clave, $row['contraseña'])) {
                // Iniciar sesión y almacenar datos del usuario en sesión
                $_SESSION['usuario'] = $row['nombre'];
                $_SESSION['id'] = $row['id'];
                $_SESSION['rol_id'] = $row['rol_id'];

                // Redirigir según el rol del usuario
                if ($_SESSION['rol_id'] == 1) { // Administrador
                    header("Location: ../views/admin_dashboard.php");
                } else { // Usuario regular
                    header("Location: ../views/user_dashboard.php");
                }
                exit();
            } else {
                $_SESSION['error'] = "Usuario o clave incorrectos.";
                header("Location: ../views/login.php");
                exit();
            }
        } else {
            $_SESSION['error'] = "Usuario o clave incorrectos.";
            header("Location: ../views/login.php");
            exit();
        }
    } catch (Exception $e) {
        $_SESSION['error'] = "Error en la conexión: " . $e->getMessage();
        header("Location: ../views/login.php");
        exit();
    }
} else {
    header("Location: ../views/login.php");
    exit();
}
