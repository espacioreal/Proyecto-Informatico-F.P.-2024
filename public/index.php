<?php
include '../config/conexion.php';
?>

<!DOCTYPE html>
<html lang="es">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NotiWeb - Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/DwwykcV8Qyq46cDfL" crossorigin="anonymous">
  </head>
  
  <body class="bg-success text-white p-3" style="width: 90%; height: 100vh; margin: 0 auto;">
  
      <nav class="navbar navbar-expand-lg bg-dark rounded">
          <div class="container-fluid mx-3">
            <a class="navbar-brand text-white" href="index.php">Inicio</a>
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
                    <a href="login.php" class="btn btn-success m-2">Login</a>
                    <a href="register.php" class="btn btn-success m-2">Register</a>
                </div>
          </div>
      </nav>


    <main style="height: 80%;">
      <div class="p-3">
        <p>Contenido principal</p>
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
