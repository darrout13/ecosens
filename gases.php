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
    <title>Comparar Gases</title>
    <link rel="stylesheet" href="CSS/inicio.css">
    <link rel="icon" href="img/LOGO.jpeg" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:700|Open+Sans&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<section class="container">
    <nav class="menu-section">
        <ul class="menu">
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
    <?php
    // Array de gases
    $gases = ['CO', 'Alcohol', 'CO2', 'Toluen', 'NH4', 'Aceton'];

    // Consultar la base de datos para obtener los datos de gases
    foreach ($gases as $gas) {
        $sql_gas = "SELECT $gas, fecha FROM mediciones_gases ORDER BY fecha DESC LIMIT 1";
        $result_gas = $conn->query($sql_gas);

        if ($result_gas->num_rows > 0) {
            $row_gas = $result_gas->fetch_assoc();
            $gas_value = $row_gas[$gas];
            $fecha_medida = $row_gas["fecha"];
            echo "
            <div class='part gas-section'>
                <h2 class='gas-title'>$gas (ppm)</h2>
                <div class='gas-item'>
                    <div class='gas-value'>$gas_value ppm</div>
                    <div class='gas-date'>$fecha_medida</div>
                </div>
            </div>";
        } else {
            echo "<p>No se encontraron datos de $gas.</p>";
        }
    }
    ?>
</section>

<script>
    // Función para actualizar los datos automáticamente con Ajax
    setInterval(function() {
        $.ajax({
            url: 'ruta_ajax.php',
            success: function(data) {
                $('.ambiente').html(data);
            }
        });
    }, 10000); // Actualizar cada 10 segundos
</script>

</body>
</html>

<!-- CSS agregado -->
<style>
.gas-title {
    color: #000000;
    text-align: center;
    margin-bottom: 10px;
    font-size: 24px;
}

.gas-value {
    font-size: 50px;
    font-weight: bold;
    color: #ffffff; /* El texto sigue siendo blanco */
    text-align: center;
}

.gas-date {
    font-size: 14px;
    color: #ffffff; /* El texto de la fecha también en blanco */
    text-align: center;
    margin-top: 10px;
}

.gas-section {
    margin-bottom: 40px;
    background-color: #4682B4; /* Azul oscuro para el fondo de la tabla */
    padding: 20px; /* Añade algo de espacio alrededor del contenido */
    border-radius: 10px; /* Bordes redondeados */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Sombra para dar un efecto visual */
}



.gas-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    background-color: #013368; /* Azul más oscuro para destacar los datos */
    padding: 15px;
    border-radius: 8px;
}

</style>
