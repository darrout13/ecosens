<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/contactar.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&family=Open+Sans&display=swap" rel="stylesheet">
    <title>EcoSense - Contactar</title>
    <link rel="icon" href="img/LOGO.jpeg." type="image/x-icon">
</head>
<body>
    <section class="container">
        <!-- Menú de navegación -->
        <nav class="menu-section">
            <ul class="menu">
                <li><a href="index.php">Inicio</a></li>
                <li><a href="login.php">Iniciar Sesión</a></li>
                <li><a href="registro.php">Registrarse</a></li>
                <li><a href="mision_vision.php">Misión y Visión</a></li>
            </ul>
        </nav>

        <section class="section" id="contactar-section">
            <!-- Sección para enviar mensaje y formulario de contacto -->
            <div class="enviar-mensaje">
                <h1 class="tex1">Enviar Mensaje</h1>
                <p>Contáctenos para cualquier pregunta, queja o sugerencia.</p>
                <!-- Formulario de contacto -->
                <form id="contact-form">
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="correo">Correo Electrónico:</label>
                        <input type="email" id="correo" name="correo" required>
                    </div>
                    <div class="form-group">
                        <label for="mensaje">Mensaje:</label>
                        <textarea id="mensaje" name="mensaje" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="mensaje-button">Enviar Mensaje</button>
                </form>
            </div>
        </section>
    </section>
    <script src="script.js"></script>
</body>
</html>