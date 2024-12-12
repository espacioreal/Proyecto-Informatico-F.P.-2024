<?php
// Datos de conexión a la base de datos desde variables de entorno
$servername = getenv('DB_SERVERNAME') ?: 'localhost';
$username = getenv('DB_USERNAME') ?: 'root';
$password = getenv('DB_PASSWORD') ?: '';
$dbname = getenv('DB_NAME') ?: 'espacioreal';

try {
    // Crear la conexión utilizando MySQLi (orientado a objetos)
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar si la conexión fue exitosa
    if ($conn->connect_error) {
        throw new Exception("Conexión fallida: " . $conn->connect_error);
    }

    // Establecer la codificación de caracteres a UTF-8 para evitar problemas con caracteres especiales
    if (!$conn->set_charset("utf8")) {
        throw new Exception("Error configurando la codificación de caracteres: " . $conn->error);
    }

    // Configuración adicional de la conexión, si es necesario
    // Por ejemplo, establecer el modo de errores de MySQLi a excepciones:
    if (!$conn->query("SET SESSION sql_mode='TRADITIONAL'")) {
        throw new Exception("Error estableciendo el modo SQL: " . $conn->error);
    }

} catch (Exception $e) {
    // Manejo de errores
    echo "Se produjo un error en la conexión: " . $e->getMessage();
    // Registrar el error en un archivo de log
    error_log($e->getMessage());
    // Opcionalmente, puedes redirigir a una página de error
    // header("Location: error.php");
    exit;  // Termina la ejecución del script
}

// Ahora puedes usar $conn para manejar la base de datos
?>
