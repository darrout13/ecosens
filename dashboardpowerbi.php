<?php
// Incluir archivos de controlador
include('controlador/nombre.php');
include('controlador/conexion.php');

// Verificar la conexión (puedes reutilizar la conexión existente o establecer una nueva)
$servername = "localhost";
$username = "root";
$password = "";
$database = "registros";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Puedes agregar cualquier lógica adicional si es necesario
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Power BI</title>
    <link rel="stylesheet" href="CSS/inicio.css">
    <link rel="icon" href="img/LOGO.jpeg" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:700|Open+Sans&display=swap" rel="stylesheet">
    <style>
        /* Estilos adicionales específicos para esta página, si es necesario */
        .iframe-container {
            position: relative;
            width: 100%;
            height: 0;
            padding-bottom: 56.25%; /* Relación de aspecto 16:9 */
            margin-bottom: 20px;
        }

        .iframe-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }
    </style>
</head>
<body>
    <section class="container">
        <!-- Menú de Navegación -->
        <nav class="menu-section">
            <ul class="menu">
                <li><a href="inicio.php" class="button back-button">Volver a tus datos</a></li>
                <li class="user-info">
                    <h1>Bienvenido(a) <?php echo htmlspecialchars($nombre_usuario); ?></h1>
                    <div class="dropdown">
                        <a href="#" class="dropbtn">Más</a>
                        <div class="dropdown-content">
                            <a href="info.php">Información</a>
                            <a href="controlador/salir.php">Cerrar Sesión</a>
                        </div>
                    </div>
                </li>
            </ul>
        </nav>

        <!-- Sección del Dashboard de Power BI -->
        <div class="full-page-section">

            <div class="iframe-container">
                <iframe 
                    title="Dashboard Power BI" 
                    src="https://app.powerbi.com/view?r=eyJrIjoiMTIyZGVhYTMtYWNkNC00MmJhLTlkN2ItNmE0ZjNkNjZlMGEzIiwidCI6IjFlOWFhYmU4LTY3ZjgtNGYxYy1hMzI5LWE3NTRlOTI0OTlhZSIsImMiOjR9" 
                    allowFullScreen="true">
                </iframe>
            </div>
        </div>

        <!-- Opcional: Otras secciones o contenido adicional -->
    </section>

    <!-- Scripts Comunes -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Si tienes scripts específicos para esta página, agréguelos aquí -->
</body>
</html>
