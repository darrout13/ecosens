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
    <title>Home</title>
    <link rel="stylesheet" href="CSS/inicio.css">
    <link rel="icon" href="img/LOGO.jpeg." type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:700|Open+Sans&display=swap" rel="stylesheet">
    <style>
        .btn-ver-detalles {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            background-color: #5f98f2; /* Color del botón */
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn-ver-detalles:hover {
            background-color: #004c97; /* Color al pasar el mouse */
            transform: translateY(-3px); /* Efecto de levantamiento */
        }
    </style>
</head>
<body>
<section class="container">
    <!-- Nueva sección para el menú de opciones -->
    <nav class="menu-section">
        <ul class="menu">
            <li id="contact-user"><a href="contactar_usuario.php">Contactar</a></li>
            <li id="contact-user"><a href="historial.php">Historial</a></li>
            <li id="contact-user"><a href="api_nacional.php">Datos Nacionales</a></li>
            <!-- Nuevo botón para acceder al Dashboard -->
            <li id="contact-user"><a href="dashboard.php">Dashboard</a></li>

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
    <!-- Primera parte: Temperatura -->
    <div class="part temperature">
        <h2>Temperatura</h2>
        <section class="desc"> 
            <div class="temp-info">
                <?php
                // Consultar la base de datos para obtener los datos de temperatura
                $sql_temperatura = "SELECT temperatura, fecha FROM mediciones_temperatura_humedad ORDER BY fecha DESC LIMIT 1";
                $result_temperatura = $conn->query($sql_temperatura);

                // Verificar si se encontraron resultados
                if ($result_temperatura->num_rows > 0) {
                    // Obtener la fila de resultados
                    $row_temperatura = $result_temperatura->fetch_assoc();
                    // Extraer el valor de temperatura y la fecha de la medida
                    $temperatura = $row_temperatura["temperatura"];
                    $fecha_medida_temperatura = $row_temperatura["fecha"];

                    // Mostrar la temperatura y la fecha de la medida
                    echo "<div class='temperature-item'>";
                    echo "<div class='temperature-value'>$temperatura °C</div>";
                    echo "<div class='temperature-date'>Última medición: $fecha_medida_temperatura</div>";
                    echo "</div>";
                } else {
                    // Mostrar un mensaje si no se encontraron datos
                    echo "<p>No se encontraron datos de temperatura.</p>";
                }
                ?>
            </div>
        </section>
    </div>

    <!-- Segunda parte: Humedad -->
    <div class="part humidity">
        <h2>Humedad</h2>
        <section class="desc"> 
            <div class="humidity-info">
                <?php
                // Consultar la base de datos para obtener los datos de humedad
                $sql_humedad = "SELECT humedad, fecha FROM mediciones_temperatura_humedad ORDER BY fecha DESC LIMIT 1";
                $result_humedad = $conn->query($sql_humedad);

                // Verificar si se encontraron resultados
                if ($result_humedad->num_rows > 0) {
                    // Obtener la fila de resultados
                    $row_humedad = $result_humedad->fetch_assoc();
                    // Extraer el valor de humedad y la fecha de la medida
                    $humedad = $row_humedad["humedad"];
                    $fecha_medida_humedad = $row_humedad["fecha"];

                    // Mostrar la humedad y la fecha de la medida
                    echo "<div class='humidity-item'>";
                    echo "<div class='humidity-value'>$humedad %</div>";
                    echo "<div class='humidity-date'>Última medición: $fecha_medida_humedad</div>";
                    echo "</div>";
                } else {
                    // Mostrar un mensaje si no se encontraron datos
                    echo "<p>No se encontraron datos de humedad.</p>";
                }
                ?>
            </div>
        </section>
    </div>

    <!-- Tercera parte: Calidad del aire -->
    <div class="part air-quality">
        <h2>Calidad del aire</h2>
        <section class="desc">
            <div class="air-quality-info">
                <?php
                // Asegúrate de que el ID del usuario está almacenado en la sesión
                if (isset($_SESSION['id_usuario'])) {
                    $id_usuario = $_SESSION['id_usuario'];

                    // Consulta para obtener la última medida de calidad del aire del usuario con la hora
                    $consulta = "SELECT valor_aire, valor_convertido_aire, m_fecha_calidad_aire FROM medicion_calidad_aire WHERE id_usuario=? ORDER BY m_fecha_calidad_aire DESC LIMIT 1";
                    $stmt = mysqli_prepare($conn, $consulta);
                    mysqli_stmt_bind_param($stmt, "i", $id_usuario);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    if ($fila = mysqli_fetch_assoc($result)) {
                        // Mostrar la última medida de calidad del aire con la hora
                        $valor_convertido_aire = $fila['valor_convertido_aire'];
                        $hora_medida = $fila['m_fecha_calidad_aire'];

                        echo "<div class='air-quality-item'>";
                        echo "<div class='air-quality-value'>$valor_convertido_aire %</div>";
                        echo "<div class='air-quality-date'>Última medición: $hora_medida</div>";
                        echo "</div>";
                    } else {
                        echo "<p>No se encontraron medidas de calidad del aire para este usuario.</p>";
                    }

                    mysqli_free_result($result);
                } else {
                    echo "<p>No se ha iniciado sesión o no se ha proporcionado un ID de usuario válido.</p>";
                }
                ?>
            </div>
            <a href="gases.php" class="btn-ver-detalles">Ver detalles</a>
        </section>
    </div>
</section>

</body>
</html>
