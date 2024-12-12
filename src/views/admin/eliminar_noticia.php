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

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($noticiaController->eliminarNoticia($id)) {
        $message = "Noticia eliminada con éxito.";
    } else {
        $error = "Error al eliminar la noticia. Por favor, intenta nuevamente.";
    }
}

header("Location: ver_noticias.php?message=" . urlencode($message ?? $error));
exit();
