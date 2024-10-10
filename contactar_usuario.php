<?php
include('controlador/conexion.php');
session_start();
if(!isset($_SESSION['usuario'])){
    header("location: login.php");
    exit;
}

$id_user = $_SESSION['usuario'];
$sql = "SELECT usuario FROM datos WHERE usuario = '$id_user'";

$result = $conex->query($sql);

$nombre_usuario = ""; // Inicializar la variable para evitar la advertencia de variable no definida

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nombre_usuario = $row['usuario']; // Asignar el nombre de usuario recuperado de la base de datos a la variable
} else {
    // Manejar el caso en que no se encuentre el nombre de usuario en la base de datos
    // Puedes mostrar un mensaje de error o asignar un valor predeterminado a $nombre_usuario
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactar</title>
    <link rel="icon" href="img/LOGO.jpeg." type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:700|Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/contactar_usuario.css">

    
</head>
<body>
<section class="container">
    <!-- Nueva sección para el menú de opciones -->
    <nav class="menu-section">
            <ul class="menu">
       
        <li id="contact-user"><a href="inicio.php">Inicio</a></li>
        <li id="contact-user"><a href="historial.php">Historial</a></li>

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

    <section class="section" id="contactar-section">
            <!-- Sección para enviar mensaje y formulario de contacto -->
            <div class="enviar-mensaje">
                <h1 class="tex1">Enviar Mensaje</h1>
                <p>Contáctenos para cualquier pregunta, queja o sugerencia.</p>
                
                <!-- Formulario de contacto -->
                <form id="contact-form">
                    <strong><label for="nombre">Nombre:</label></strong>
                    <input type="text" id="nombre" name="nombre" required>

                    <strong><label for="correo">Correo Electrónico:</label></strong>
                    <input type="email" id="correo" name="correo" required>

                    <strong><label for="mensaje">Mensaje:</label></strong>
                    <textarea id="mensaje" name="mensaje" rows="4" required></textarea>

                    <button type="submit" class="mensaje-button">Enviar Mensaje</button>
                </form>
            </div>
        </section>
</section>
    
</body>
</html>