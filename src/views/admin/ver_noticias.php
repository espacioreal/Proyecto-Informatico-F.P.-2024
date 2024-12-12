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
$noticias = $noticiaController->obtenerTodasLasNoticias();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Ver Noticias</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Ver Noticias</h1>
        <?php if (isset($_GET['message'])): ?>
            <div class="alert alert-success"><?php echo $_GET['message']; ?></div>
        <?php endif; ?>
        <?php if (!empty($noticias)): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Categoría</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($noticias as $noticia): ?>
                        <tr>
                            <td><?php echo $noticia['titulo']; ?></td>
                            <td><?php echo $noticia['autor']; ?></td>
                            <td><?php echo $noticia['categoria']; ?></td>
                            <td><?php echo $noticia['fecha_publicacion']; ?></td>
                            <td>
                                <a href="editar_noticia.php?id=<?php echo $noticia['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                                <a href="eliminar_noticia.php?id=<?php echo $noticia['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar esta noticia?');">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No hay noticias para mostrar.</p>
        <?php endif; ?>
    </div>
</body>
</html>
