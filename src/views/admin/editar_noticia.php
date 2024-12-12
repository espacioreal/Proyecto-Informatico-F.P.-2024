<?php
session_start();
include '../config/conexion.php';
include '../controllers/NoticiaController.php';

// Verificar si el usuario es un administrador
if (!isset($_SESSION['rol_id']) || $_SESSION['rol_id'] != 1) {
    header("Location: ../login.php");
    exit();
}

$noticiaController = new NoticiaController();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $contenido = $_POST['contenido'];
    $categoria_id = $_POST['categoria_id'];

    if ($noticiaController->editarNoticia($id, $titulo, $contenido, $categoria_id)) {
        $message = "Noticia actualizada con éxito.";
    } else {
        $error = "Error al actualizar la noticia. Por favor, intenta nuevamente.";
    }
} else {
    $id = $_GET['id'];
    $noticia = $noticiaController->obtenerNoticia($id);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Editar Noticia</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Editar Noticia</h1>
        <?php if (isset($message)): ?>
            <div class="alert alert-success"><?php echo $message; ?></div>
        <?php endif; ?>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="POST" action="">
            <input type="hidden" name="id" value="<?php echo $noticia['id']; ?>">
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo $noticia['titulo']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="contenido" class="form-label">Contenido</label>
                <textarea class="form-control" id="contenido" name="contenido" rows="5" required><?php echo $noticia['contenido']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="categoria_id" class="form-label">Categoría</label>
                <select class="form-select" id="categoria_id" name="categoria_id" required>
                    <?php
                    $sql = "SELECT id, nombre FROM categorias";
                    $result = $conn->query($sql);
                    while ($categoria = $result->fetch_assoc()) {
                        $selected = $categoria['id'] == $noticia['categoria_id'] ? "selected" : "";
                        echo "<option value='{$categoria['id']}' $selected>{$categoria['nombre']}</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="../admin/admin_dashboard.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>
