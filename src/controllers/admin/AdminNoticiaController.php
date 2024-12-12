<?php
include '../config/conexion.php';

class AdminNoticiaController {
    
    public function listarNoticias() {
        global $conn;
        $sql = "SELECT * FROM noticias";
        $result = $conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function obtenerNoticia($id) {
        global $conn;
        $sql = "SELECT * FROM noticias WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function crearNoticia($titulo, $contenido, $usuario_id, $categoria_id) {
        global $conn;
        $sql = "INSERT INTO noticias (titulo, contenido, usuario_id, categoria_id) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssii", $titulo, $contenido, $usuario_id, $categoria_id);
        return $stmt->execute();
    }

    public function editarNoticia($id, $titulo, $contenido, $categoria_id) {
        global $conn;
        $sql = "UPDATE noticias SET titulo = ?, contenido = ?, categoria_id = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssii", $titulo, $contenido, $categoria_id, $id);
        return $stmt->execute();
    }

    public function eliminarNoticia($id) {
        global $conn;
        $sql = "DELETE FROM noticias WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
