<?php
session_start();
include '../config/conexion.php';

// Verificar si el usuario es un administrador
if (!isset($_SESSION['rol_id']) || $_SESSION['rol_id'] != 1) {
    header("Location: ../login.php");
    exit();
}

// Consultas para obtener estadísticas
$total_usuarios = $conn->query("SELECT COUNT(*) AS total FROM usuarios")->fetch_assoc()['total'];
$total_noticias = $conn->query("SELECT COUNT(*) AS total FROM noticias")->fetch_assoc()['total'];
$total_comentarios = $conn->query("SELECT COUNT(*) AS total FROM comentarios")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Panel de Administración</title>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Panel de Administración</h1>

        <!-- Sección de estadísticas -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Total de Usuarios</div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $total_usuarios; ?></h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">Total de Noticias</div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $total_noticias; ?></h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-header">Total de Comentarios</div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $total_comentarios; ?></h5>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navegación de gestión -->
        <div class="list-group mb-4">
            <a href="gestionar_usuarios.php" class="list-group-item list-group-item-action">Gestionar Usuarios</a>
            <a href="gestionar_noticias.php" class="list-group-item list-group-item-action">Gestionar Noticias</a>
            <a href="gestionar_comentarios.php" class="list-group-item list-group-item-action">Gestionar Comentarios</a>
        </div>

        <!-- Botón de logout -->
        <a href="../logout.php" class="btn btn-danger">Cerrar Sesión</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
