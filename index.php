<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <link rel="icon" href="img/LOGO.jpeg" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&family=Open+Sans&family=Roboto&display=swap" rel="stylesheet">
    <title>EcoSense</title>
    <style>
        /* Estilos para el botón de IA */
        .ia-button {
            width: 200px; /* Ajusta según sea necesario */
            padding: 10px 20px;
            margin: 5px;
            background-color:  white;
            color: black;
            border: none;
            border-radius: 5px; /* Bordes redondeados */
            cursor: pointer;
            transition: background-color 0.3s; /* Animación de fondo */
        }

        .ia-button:hover {
            background-color: #2c3e50;
        }
    </style>
</head>
<body>

    <section class="container">
        <!-- Nueva sección para el menú de opciones -->
        <nav class="menu-section">
            <ul class="menu">
                <li><a href="#">Inicio</a></li>
                <li><a href="#section3">Sobre nosotros</a></li>
                <li><a href="mision_vision.php">Misión y Visión</a></li>
                <li><a href="contactar.php">Contactar</a></li>
            </ul>
        </nav>

        <section id="section1" class="section">
            <img src="img/LOGO.jpeg" alt="">
            <h2 class="letra-logo">Iniciar Sesión</h2>
            <h5>Accede a tu cuenta con tu correo y contraseña.</h5>
            <div class="button-container">
                <button class="login-button" onclick="navigateTo('login.php')">Ingresar</button>
                <button class="registrar-button" onclick="navigateTo('registro.php')">Registrarse</button>
            </div>
        </section>

        <section id="section2" class="section">
            <h2>Chat</h2>
            <div class="telegram">
                <h5>Inicio de visualización</h5>
                <p>Mantén una comunicación con el prototipo.</p>
                <button class="conversacion-button" onclick="navigateTo('inicio.php')">Ver datos meteorológicos</button>
            </div>
            <div class="ia-info">
                <h5>Infórmate bien sobre todos nuestros datos meteorológicos con nuestra IA</h5>
                <button class="ia-button" onclick="redireccionar()">Ir a la IA</button>
            </div>
            <div class="notificaciones">
                <h5>Notificaciones</h5>
                <p>Recibe alertas instantáneas para no perder ningún dato importante.</p>
                <button class="noticias-button">Abrir noticias</button>
            </div>
            <h2>Funcionalidades</h2>
            <div class="funcionalidades">
                <div class="colunma">
                    <h3>1. Envío de Mensaje</h3>
                    <p>Interactúa con un click de manera sencilla y rápida.</p>
                </div>
                <div class="colunma">
                    <h3>2. Compartir Información</h3>
                    <p>Comparte los datos con demás personas, para que se informen acerca del ambiente del campus.</p>
                </div>
                <div class="colunma">
                    <h3>3. Historial de Conversaciones</h3>
                    <p>Accede a los datos anteriores para no perder detalles importantes.</p>
                </div>
            </div>
            <div class="container">
                <img src="img/correo.png" alt="Imagen" class="imgc">
                <p class="tex3">Contáctanos</p>
                <p class="ps">Con solo un par de clics, podrás contactarte con nosotros.</p>
                <button class="mensaje-button" onclick="navigateTo('contactar.php')">Enviar mensaje</button>
            </div>
        </section>

        <section class="section" id="section3">
            <h2>Sobre Nosotros</h2>
            <div class="sobre-nosotros-contenido">
                <p>
                    Bienvenido a EcoSense, tu plataforma de conciencia ambiental. 
                    Nos dedicamos a proporcionar información precisa y relevante sobre la calidad del aire
                    y promovemos prácticas sostenibles para preservar nuestro campus universitario.
                </p>
                <p>Conócenos más a fondo y descubre cómo puedes contribuir a un mundo más ecológico.</p>
            </div>
        </section>

    </section>

    <script src="JS/login.js"></script>
    <script>
        function redireccionar() {
            window.location.href = 'http://localhost/ECO_SENSE/Inteligencia_artificial/GPT.html';
        }

        function generateText() {
            // Mostrar mensaje de carga
            document.getElementById('loading').style.display = 'block';

            // Obtener la consulta del textarea
            var consulta = document.getElementById('prompt').value;

            // Realizar solicitud POST al servidor Flask
            fetch('http://127.0.0.1:5000/generate', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ consulta: consulta })
            })
            .then(response => response.json())
            .then(data => {
                // Actualizar el contenido del elemento HTML con el texto generado
                document.getElementById('output').textContent = data.generated_text;
            })
            .catch(error => {
                // Manejar errores mostrando una alerta
                alert('Error al generar el texto.');
            })
            .finally(() => {
                // Ocultar el mensaje de carga después de completar la solicitud
                document.getElementById('loading').style.display = 'none';
            });
        }

        // Ejecutar la función generateText cuando se hace clic en el botón "Generar Texto"
        document.getElementById('generate-btn').addEventListener('click', generateText);
    </script>
</body>
</html>
