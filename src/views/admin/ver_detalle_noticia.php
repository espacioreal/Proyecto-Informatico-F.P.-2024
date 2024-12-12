<?php
session_start();
include '../config/conexion.php';
include '../controllers/NoticiaController.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['rol_id'])) {
    header("Location: ../login.php");
    exit();
}

$noticiaController = new NoticiaController();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $noticia = $noticiaController->obtenerNoticia($id);
    if (!$noticia) {
        $error = "No se encontró la noticia.";
    }
} else {
    $error = "ID de noticia no especificado.";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Detalle de Noticia</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Detalle de Noticia</h1>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php else: ?>
            <h2><?php echo $noticia['titulo']; ?></h2>
            <p><strong>Autor:</strong> <?php echo $noticia['usuario_id']; ?></p>
            <p><strong>Categoría:</strong> <?php echo $noticia['categoria_id']; ?></p>
            <p><strong>Fecha de Publicación:</strong> <?php echo $noticia['fecha_publicacion']; ?></p>
            <p><?php echo nl2br($noticia['contenido']); ?></p>
            <a href="ver_noticias.php" class="btn btn-secondary">Volver</a>
        <?php endif; ?>
    </div>
</body>
</html>
