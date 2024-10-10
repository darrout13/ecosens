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

// Consultar datos de calidad del aire
$sql_calidad = "SELECT m_fecha_calidad_aire, valor_aire FROM medicion_calidad_aire ORDER BY m_fecha_calidad_aire DESC LIMIT 5";
$result_calidad = $conn->query($sql_calidad);
$calidad_data = [];
$labels_calidad = [];

if ($result_calidad && $result_calidad->num_rows > 0) {
    while ($row = $result_calidad->fetch_assoc()) {
        $calidad_data[] = $row['valor_aire'];
        $labels_calidad[] = $row['m_fecha_calidad_aire'];
    }
}

// Consultar datos de gases
$gases = ['CO', 'Alcohol', 'CO2', 'Toluen', 'NH4', 'Aceton'];
$gases_data = [];

foreach ($gases as $gas) {
    $sql_gas = "SELECT fecha, $gas FROM mediciones_gases ORDER BY fecha DESC LIMIT 5";
    $result_gas = $conn->query($sql_gas);
    $data = [];
    $labels_gas = [];

    if ($result_gas && $result_gas->num_rows > 0) {
        while ($row = $result_gas->fetch_assoc()) {
            $data[] = $row[$gas];
            $labels_gas[] = $row['fecha'];
        }
    }
    $gases_data[$gas] = [
        'data' => $data,
        'labels' => $labels_gas,
    ];
}

// Consultar datos de temperatura y humedad
$sql_temp_hum = "SELECT fecha, temperatura, humedad FROM mediciones_temperatura_humedad ORDER BY fecha DESC LIMIT 5";
$result_temp_hum = $conn->query($sql_temp_hum);
$temp_data = [];
$hum_data = [];
$labels_temp_hum = [];

if ($result_temp_hum && $result_temp_hum->num_rows > 0) {
    while ($row = $result_temp_hum->fetch_assoc()) {
        $temp_data[] = $row['temperatura'];
        $hum_data[] = $row['humedad'];
        $labels_temp_hum[] = $row['fecha'];
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Futurista de Meteorología</title>
    <link rel="stylesheet" href="CSS/inicio.css">
    <link rel="icon" href="img/LOGO.jpeg" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:700|Open+Sans&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #0e0e0e;
            color: #fff;
            margin: 0;
            padding: 0;
            overflow-y: scroll; /* Permite desplazamiento vertical */
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .menu-section {
            background-color: #013368;
            padding: 10px;
            color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.5);
        }

        .menu a {
            color: #ffffff;
            text-decoration: none;
            padding: 10px;
        }

        h2 {
            font-family: 'Montserrat', sans-serif;
            font-weight: bold;
            color: #f39c12;
            margin-bottom: 20px;
            text-align: center;
            text-shadow: 2px 2px #333;
        }

        .full-page-section {
            background: #2c3e50;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
            margin-bottom: 30px;
            padding: 20px;
            animation: slideIn 0.5s forwards;
        }

        @keyframes slideIn {
            from {
                transform: translateY(20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .chart-container {
            position: relative;
            height: 400px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
        }

        table th, table td {
            border: none;
            padding: 15px;
            text-align: center;
            background-color: #34495e;
            transition: background-color 0.3s ease;
        }

        table th {
            background-color: #2980b9;
            color: #fff;
        }

        table tbody tr:hover {
            background-color: #1abc9c;
            transform: scale(1.02);
            transition: transform 0.3s ease;
        }

        .explanation {
            background: rgba(255, 255, 255, 0.1);
            padding: 10px;
            border-radius: 5px;
            margin: 20px 0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.5);
        }

        /* Estilo del gráfico de pastel */
        .doughnut-chart {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
        }

    </style>
</head>
<body>
    <section class="container">
        <nav class="menu-section">
            <ul class="menu">
                <li><a href="inicio.php" class="button back-button">Volver a tus datos</a></li>
                <li><a href="dashboardpowerbi.php" class="button">Dashboard Histórico</a></li>
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

        <!-- Gráfico de Calidad del Aire -->
        <div class="full-page-section">
            <h2>Calidad del Aire</h2>
            <div class="chart-container">
                <canvas id="calidadChart"></canvas>
            </div>
        </div>

        <!-- Gráfico de Temperatura y Humedad -->
        <div class="full-page-section">
            <h2>Temperatura y Humedad</h2>
            <div class="chart-container">
                <canvas id="tempChart"></canvas>
            </div>
        </div>

        <!-- Tabla para los Gases -->
        <?php foreach ($gases as $gas): ?>
        <div class="full-page-section">
            <h2><?php echo $gas; ?> (ppm)</h2>
            <table>
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th><?php echo $gas; ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($gases_data[$gas]['labels'] as $index => $label): ?>
                        <tr class="hover-row">
                            <td><?php echo $label; ?></td>
                            <td><?php echo $gases_data[$gas]['data'][$index]; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php endforeach; ?>

        <!-- Gráfico Circular para Temperatura Nacional -->
        <div class="full-page-section">
            <h2>Temperatura Nacional</h2>
            <div class="chart-container doughnut-chart">
                <canvas id="tempNacionalChart"></canvas>
            </div>
            <div class="explanation">
                <p>Este gráfico muestra la temperatura media en diferentes ciudades del país.</p>
            </div>
        </div>
        
        <!-- Explicaciones de los Datos -->
        <div class="explanation">
            <p>Los datos presentados en esta sección reflejan las mediciones más recientes de calidad del aire, temperatura y gases. Mantente informado sobre el estado de tu ambiente.</p>
<!-- Video de Meteorología -->
<div class="video-container">
    <iframe src="https://www.youtube.com/embed/Y-vPuITUTj0" frameborder="0" allowfullscreen></iframe>
</div>

<!-- Espacio para la imagen de la planta nuclear -->
<div class="nuclear-plant-container">
    <img src="img/OIP.jpeg" alt="Planta Nuclear 3D" class="nuclear-plant" />
</div>

<style>
    .video-container {
        display: flex;
        justify-content: center;
        align-items: center; /* Centra verticalmente el contenido */
        margin: 20px 0;
    }

    iframe {
        width: 80%; /* Ajusta el ancho del video */
        height: 450px; /* Ajusta la altura del video */
        max-width: 800px; /* Establece un ancho máximo para el video */
    }
</style>
        <!-- Explicaciones de los Datos -->
        <div class="explanation">
            <p>Los datos presentados en esta sección reflejan las mediciones más recientes de calidad del aire, temperatura y gases. Mantente informado sobre el estado de tu ambiente.</p>
        </div>
        </section>

    <script>
        // Gráfico de Calidad del Aire
        const ctxCalidad = document.getElementById('calidadChart').getContext('2d');
        const calidadChart = new Chart(ctxCalidad, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($labels_calidad); ?>,
                datasets: [{
                    label: 'Calidad del Aire (ppm)',
                    data: <?php echo json_encode($calidad_data); ?>,
                    borderColor: '#f39c12',
                    backgroundColor: 'rgba(243, 156, 18, 0.2)',
                    borderWidth: 2,
                    fill: true,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Valores (ppm)',
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Fecha',
                        }
                    }
                }
            }
        });

        // Gráfico de Temperatura y Humedad
        const ctxTemp = document.getElementById('tempChart').getContext('2d');
        const tempChart = new Chart(ctxTemp, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($labels_temp_hum); ?>,
                datasets: [
                    {
                        label: 'Temperatura (°C)',
                        data: <?php echo json_encode($temp_data); ?>,
                        backgroundColor: '#2980b9',
                        borderColor: '#1abc9c',
                        borderWidth: 1,
                    },
                    {
                        label: 'Humedad (%)',
                        data: <?php echo json_encode($hum_data); ?>,
                        backgroundColor: '#e74c3c',
                        borderColor: '#c0392b',
                        borderWidth: 1,
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Valores',
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Fecha',
                        }
                    }
                }
            }
        });

        // Gráfico Circular para Temperatura Nacional
        const ctxTempNacional = document.getElementById('tempNacionalChart').getContext('2d');
        const tempNacionalChart = new Chart(ctxTempNacional, {
            type: 'doughnut',
            data: {
                labels: ['Ciudad A', 'Ciudad B', 'Ciudad C', 'Ciudad D'],
                datasets: [{
                    data: [10, 40, 30, 43], // Datos de ejemplo, reemplaza con datos reales
                    backgroundColor: ['#3498db', '#2ecc71', '#e74c3c', '#f1c40f'],
                    borderColor: '#fff',
                    borderWidth: 2,
                }]
            },
            
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: (tooltipItem) => {
                                return `${tooltipItem.label}: ${tooltipItem.raw}°C`;
                            }
                        }
                    }
                }
            }
        });

    </script>
</body>
</html>

