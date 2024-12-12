<?php
session_start();
include '../config/conexion.php';
include '../controllers/NoticiaController.php';

// Verificar si el usuario es un administrador
if (!isset($_SESSION['rol_id']) || $_SESSION['rol_id'] != 1) {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $contenido = $_POST['contenido'];
    $usuario_id = $_SESSION['id']; // Asumiendo que el usuario está logueado
    $categoria_id = $_POST['categoria_id'];

    $noticiaController = new NoticiaController();
    if ($noticiaController->crearNoticia($titulo, $contenido, $usuario_id, $categoria_id)) {
        header("Location: ../admin/admin_dashboard.php?message=Noticia creada exitosamente");
        exit();
    } else {
        $error = "Error al crear la noticia. Por favor, intenta nuevamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Crear Noticia</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Crear Noticia</h1>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" required>
            </div>
            <div class="mb-3">
                <label for="contenido" class="form-label">Contenido</label>
                <textarea class="form-control" id="contenido" name="contenido" rows="5" required></textarea>
            </div>
            <div class="mb-3">
                <label for="categoria_id" class="form-label">Categoría</label>
                <select class="form-select" id="categoria_id" name="categoria_id" required>
                    <!-- Aquí puedes cargar las categorías desde la base de datos -->
                    <?php
                    $sql = "SELECT id, nombre FROM categorias";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Crear</button>
            <a href="../admin/admin_dashboard.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>
