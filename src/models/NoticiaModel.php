<?php
include '../config/conexion.php';

class NoticiaModel {
    private $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    public function obtenerTodasLasNoticias() {
        $sql = "SELECT * FROM noticias";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function obtenerNoticiaPorId($id) {
        $sql = "SELECT * FROM noticias WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function crearNoticia($titulo, $contenido, $usuario_id, $categoria_id) {
        $sql = "INSERT INTO noticias (titulo, contenido, usuario_id, categoria_id) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssii", $titulo, $contenido, $usuario_id, $categoria_id);
        return $stmt->execute();
    }

    public function actualizarNoticia($id, $titulo, $contenido, $categoria_id) {
        $sql = "UPDATE noticias SET titulo = ?, contenido = ?, categoria_id = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssii", $titulo, $contenido, $categoria_id, $id);
        return $stmt->execute();
    }

    public function eliminarNoticia($id) {
        $sql = "DELETE FROM noticias WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
