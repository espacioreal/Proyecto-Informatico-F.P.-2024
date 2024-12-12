<?php
session_start(); // Iniciar la sesión
include '../config/conexion.php';

// Consulta para obtener noticias de la base de datos
$sql = "SELECT titulo, contenido FROM noticias ORDER BY fecha_publicacion DESC LIMIT 5";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NotiWeb - Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/DwwykcV8Qyq46cDfL" crossorigin="anonymous">
    <link rel="stylesheet" href="/Proyecto-Informatico-F.P.-2024/public/css/style.css"> <!-- Ruta absoluta para el CSS -->
</head>

<body class="bg-success text-white p-3" style="width: 90%; height: 100vh; margin: 0 auto;">

    <nav class="navbar navbar-expand-lg bg-dark rounded">
        <div class="container-fluid mx-3">
            <a class="navbar-brand text-white" href="/Proyecto-Informatico-F.P.-2024/public/index.php">
                <img src="/Proyecto-Informatico-F.P.-2024/public/images/logo.png" alt="Logo" width="30" height="30" class="d-inline-block align-top">
                Inicio
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <form class="d-flex" role="search" style="align-items: center;">
                <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">🔍</button>
            </form>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <!-- Espacio para posibles enlaces de navegación adicionales -->
                </ul>
                <?php if (isset($_SESSION['usuario'])): ?>
                    <div class="navbar-text">
                        <img src="/Proyecto-Informatico-F.P.-2024/public/images/profile_default.png" alt="Perfil" width="30" height="30" class="rounded-circle">
                        <span><?php echo htmlspecialchars($_SESSION['usuario']); ?></span>
                    </div>
                    <a href="logout.php" class="btn btn-success m-2">Cerrar Sesión</a>
                <?php else: ?>
                    <a href="/Proyecto-Informatico-F.P.-2024/public/login.php" class="btn btn-success m-2">Login</a>
                    <a href="/Proyecto-Informatico-F.P.-2024/public/register.php" class="btn btn-success m-2">Register</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <main style="height: 80%;">
        <div class="p-3">
            <h1>Bienvenido a NotiWeb</h1>

            <!-- Carrusel de Noticias -->
            <div id="newsCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php
                    $active = 'active';
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<div class="carousel-item ' . $active . '">';
                            echo '<div class="d-block w-100" style="background-color: #000; color: #fff; height: 200px; display: flex; align-items: center; justify-content: center;">';
                            echo '<h5>' . htmlspecialchars($row["titulo"]) . '</h5>';
                            echo '<p>' . htmlspecialchars($row["contenido"]) . '</p>';
                            echo '</div></div>';
                            $active = '';
                        }
                    } else {
                        echo '<div class="carousel-item active">';
                        echo '<div class="d-block w-100" style="background-color: #000; color: #fff; height: 200px; display: flex; align-items: center; justify-content: center;">';
                        echo '<h5>No hay noticias disponibles.</h5>';
                        echo '</div></div>';
                    }
                    ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#newsCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#newsCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Siguiente</span>
                </button>
            </div>
        </div>
    </main>

    <footer class="bg-success text-center text-lg-start">
        <div class="text-center p-3 bg-dark text-white rounded">
            © 2024 NotiWeb
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
