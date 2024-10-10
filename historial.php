<?php
include('controlador/nombre.php');

// Verificar si el usuario está logeado
if (!isset($_SESSION['usuario'])) {
    // Si el usuario no está logeado, redirigir al formulario de inicio de sesión
    header("Location: /ECO_SENSE/login.php");
    exit();
}

// Obtener el ID del usuario logeado
$id_usuario = $_SESSION['id_usuario'];

// Establecer la conexión a la base de datos
$conex = mysqli_connect("localhost", "root", "", "registros");

// Consulta SQL para obtener el historial de calidad del aire con las mediciones de temperatura y humedad correspondientes
$sql = "
    SELECT 
        medicion_calidad_aire.m_fecha_calidad_aire, 
        medicion_calidad_aire.valor_convertido_aire, 
        mediciones_temperatura_humedad.temperatura, 
        mediciones_temperatura_humedad.humedad
    FROM 
        medicion_calidad_aire
    LEFT JOIN 
        mediciones_temperatura_humedad 
    ON 
        medicion_calidad_aire.m_fecha_calidad_aire = mediciones_temperatura_humedad.fecha
    WHERE 
        medicion_calidad_aire.id_usuario = $id_usuario
    ORDER BY 
        medicion_calidad_aire.m_fecha_calidad_aire DESC
";

// Ejecutar la consulta
$result = mysqli_query($conex, $sql);

// Verificar si se encontraron resultados
if (!$result) {
    echo "Error al obtener datos del historial de calidad del aire.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoSense - Historial</title>
    <link rel="stylesheet" href="css/historial.css">
    <link rel="icon" href="img/LOGO.jpeg." type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:700|Open+Sans&display=swap" rel="stylesheet">
</head>
<body>
<section class="container">
        <!-- Nueva sección para el menú de opciones -->
        <nav class="menu-section">
            <ul class="menu">
                <li id="contact-user"><a href="inicio.php">Inicio</a></li>
                <li id="contact-user"><a href="contactar_usuario.php">Contactar</a></li>
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

        <div class="tabla-datos">
         <table>
          <thead>
            <tr>
                <th>Fecha y Hora</th>
                <th>Calidad del aire</th>
                <th>Humedad (%)</th>
                <th>Temperatura (C°)</th>
            </tr>
         </thead>
         <tbody>
         <?php
            // Mostrar los resultados del historial
            while ($fila = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                    echo "<td>" . $fila['m_fecha_calidad_aire'] . "</td>";
                    echo "<td>" . $fila['valor_convertido_aire'] . "%</td>";
                    echo "<td>" . $fila['humedad'] . "%</td>";
                    echo "<td>" . $fila['temperatura'] . " C°</td>";
                echo "</tr>";
            }
            ?>
          </tbody>
         </table>
        </div>
</section>
</body>
</html>
