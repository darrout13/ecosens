<?php
include('controlador/nombre.php');
include('controlador/conexion.php');

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
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comparar Nacional</title>
    <link rel="stylesheet" href="CSS/inicio.css">
    <link rel="icon" href="img/LOGO.jpeg" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:700|Open+Sans&display=swap" rel="stylesheet">
</head>
<body>
<section class="container">
    <!-- Nueva sección para el menú de opciones -->
    <nav class="menu-section">
        <ul class="menu">
            <!-- Botón para regresar a las tablas locales -->
            <li><a href="inicio.php" class="button back-button">Volver a tus datos</a></li>
            <li class="user-info">
                <h1>Bienvenido(a) <?php echo $nombre_usuario; ?></h1>
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
</section>

<section class="ambiente">
    <!-- Datos Nacionales: Temperatura -->
    <div class="part temperature">
        <h2>Temperatura Nacional</h2>
        <section class="desc"> 
            <div class="temp-info">
                <?php
                // Consultar la base de datos para obtener la última medición de temperatura
                $sql_temperatura_nacional = "SELECT temperatura2, fecha FROM mediciones_nacional ORDER BY fecha DESC LIMIT 1";
                $result_temperatura_nacional = $conn->query($sql_temperatura_nacional);

                if ($result_temperatura_nacional->num_rows > 0) {
                    $row_temperatura_nacional = $result_temperatura_nacional->fetch_assoc();
                    $temperatura2 = $row_temperatura_nacional["temperatura2"];
                    $fecha_medida_temperatura = $row_temperatura_nacional["fecha"];

                    // Mostrar el valor de temperatura con letras grandes y la fecha más pequeña debajo
                    echo "<div class='temperature-item'>";
                    echo "<div class='temperature-value'>$temperatura2 °C</div>";
                    echo "<div class='temperature-date'>$fecha_medida_temperatura</div>";
                    echo "</div>";
                } else {
                    echo "<p>No se encontraron datos de temperatura nacional.</p>";
                }
                ?>
            </div>
        </section>
    </div>

    <!-- Datos Nacionales: Humedad -->
    <div class="part humidity">
        <h2>Humedad Nacional</h2>
        <section class="desc"> 
            <div class="humidity-info">
                <?php
                // Consultar la base de datos para obtener la última medición de humedad
                $sql_humedad_nacional = "SELECT humedad2, fecha FROM mediciones_nacional ORDER BY fecha DESC LIMIT 1";
                $result_humedad_nacional = $conn->query($sql_humedad_nacional);

                if ($result_humedad_nacional->num_rows > 0) {
                    $row_humedad_nacional = $result_humedad_nacional->fetch_assoc();
                    $humedad2 = $row_humedad_nacional["humedad2"];
                    $fecha_medida_humedad = $row_humedad_nacional["fecha"];

                    // Mostrar el valor de humedad con letras grandes y la fecha más pequeña debajo
                    echo "<div class='humidity-item'>";
                    echo "<div class='humidity-value'>$humedad2 %</div>";
                    echo "<div class='humidity-date'>$fecha_medida_humedad</div>";
                    echo "</div>";
                } else {
                    echo "<p>No se encontraron datos de humedad nacional.</p>";
                }
                ?>
            </div>
        </section>
    </div>
</section>

</body>
</html>

<!-- CSS agregado -->
<style>
.temperature-value, .humidity-value {
    font-size: 50px;
    font-weight: bold;
    color: #ffffff;
}

.temperature-date, .humidity-date {
    font-size: 14px;
    color: #ffffff;
    margin-top: 10px;
    text-align: center;
}

.temperature-item, .humidity-item {
    display: flex;
    flex-direction: column;
    align-items: center;
}
</style>
