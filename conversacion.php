<!-- conversacion.html -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/conversacion.css">
    <link rel="icon" href="img/LOGO.jpeg." type="image/x-icon">
    <title>EcoSense - Conversación</title>
</head>
<body>

    <section class="container">
        <!-- Nueva sección para el menú de opciones -->
        <nav class="menu-section">
            <ul class="menu">
                <li><a href="index.php">Inicio</a></li>
                <li><a href="contactar.php">Contactar</a></li>
                <li><a href="index.html">Cerrar sesion</a></li>

            </ul>
        </nav>

        <section class="conversacion-section">
            <!-- Sección para la conversación -->
            <div class="conversacion-container">
                <!-- Aquí irán los mensajes de la conversación -->
            </div>

            <!-- Formulario de enviar mensaje -->
            <div class="enviar-mensaje">
                <input type="text" class="enviar-mensaje-input" placeholder="Que quieres consultar">
                <button class="enviar-mensaje-button">Enviar</button>
            </div>
        </section>
    </section>

    <script src="script.js"></script>
</body>
</html>
