<?php
include '../config/conexion.php';

class AdminUsuarioController {
    
    public function listarUsuarios() {
        global $conn;
        $sql = "SELECT * FROM usuarios";
        $result = $conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function obtenerUsuario($id) {
        global $conn;
        $sql = "SELECT * FROM usuarios WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function crearUsuario($nombre, $email, $contraseña, $rol_id) {
        global $conn;
        $hashedPassword = password_hash($contraseña, PASSWORD_DEFAULT);
        $sql = "INSERT INTO usuarios (nombre, email, contraseña, rol_id) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $nombre, $email, $hashedPassword, $rol_id);
        return $stmt->execute();
    }

    public function editarUsuario($id, $nombre, $email, $rol_id) {
        global $conn;
        $sql = "UPDATE usuarios SET nombre = ?, email = ?, rol_id = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssii", $nombre, $email, $rol_id, $id);
        return $stmt->execute();
    }

    public function eliminarUsuario($id) {
        global $conn;
        $sql = "DELETE FROM usuarios WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
