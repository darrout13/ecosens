<?php
include('controlador/conexion.php');

session_start();
if(!isset($_SESSION['usuario'])){
    header("location: login.php");
    exit;
}

$id_user = $_SESSION['usuario'];
$sql = "SELECT usuario, nombres, apellidos, correo, contraseña FROM datos WHERE usuario = '$id_user'";


$result = $conex->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    $nombre_usuario = $row['usuario']; // Asignar el nombre de usuario recuperado de la base de datos a la variable

    $apellido_usuario= $row['apellidos'];
    $name_usuario= $row['nombres'];
    $correo_usuario= $row['correo'];
    $contraseña_usuario= $row['contraseña'];
    
} else {
    // Manejar el caso en que no se encuentre el nombre de usuario en la base de datos
    // Puedes mostrar un mensaje de error o asignar un valor predeterminado a $nombre_usuario
}
?>

<script>
function mostrarContrasena() {
    var contrasenaInput = document.getElementById("contrasena");
    if (contrasenaInput.type === "password") {
        contrasenaInput.type = "text";
    } else {
        contrasenaInput.type = "password";
    }
}

function mostrarFormulario() {
    var formulario = document.querySelector(".form-modificar");
    if (formulario.style.display === "none") {
        formulario.style.display = "block";
    } else {
        formulario.style.display = "none";
    }
}
</script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informacion - User</title>
    <link rel="stylesheet" href="css/info.css">
    <link rel="icon" href="img/LOGO.jpeg." type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:700|Open+Sans&display=swap" rel="stylesheet">
</head>
<body>
<section class="container">
    <!-- Nueva sección para el menú de opciones -->
    <nav class="menu-section">
        <ul class="menu">
            <li id="contact-user"><a href="inicio.php">Inicio</a></li>
            <li id="contact-user"><a href="historial.php">Historial</a></li>
            <li class="user-info">
                <h1>Bienvenido(a) <?php echo $nombre_usuario;?> </h1>
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

<section class="section">
    <h2>Información del usuario:</h2>
    <div class="info">
        <p><strong>Nombre:</strong> <span class="datos"> <?php echo $name_usuario; ?> </span></p>
        <p><strong>Apellidos:</strong> <span class="datos"> <?php echo $apellido_usuario; ?> </span></p>
        
        <p><strong>Usuario:</strong> <span class="datos"> <?php echo $nombre_usuario; ?> </span></p>
        <p><strong>Correo:</strong> <span class="datos"> <?php echo $correo_usuario; ?> </span></p>
        <p><strong>Contraseña:</strong> <span class="datos">
            <input type="password" id="contrasena" value="<?php echo $contraseña_usuario; ?>" readonly>
            <button onclick="mostrarContrasena()">Mostrar</button>
        </span></p> 

        <button onclick="mostrarFormulario()">Modificar Datos</button>
        <form class="form-modificar" action="controlador/guardar_modificaciones.php" method="post">
            <p><strong>Nombre:</strong> <input type="text" name="nombre" value="<?php echo $name_usuario; ?>"></p>
            <p><strong>Apellidos:</strong> <input type="text" name="apellidos" value="<?php echo $apellido_usuario; ?>"></p>
            
            <p><strong>Nombre de usuario:</strong> <input type="text" name="usuario" value="<?php echo $nombre_usuario; ?>"></p>

            <p><strong>Correo:</strong> <input type="email" name="correo" value="<?php echo $correo_usuario; ?>"></p>
            <p><strong>Nueva Contraseña:</strong> <input type="password" name="contrasena"></p>
            <button type="submit" class="boton">Guardar Cambios</button>
        </form>
    </div>
</section>
</body>
</html>
