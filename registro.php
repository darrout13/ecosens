
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/registros.css">
    <title>EcoSense - Registrarse</title>
</head>
<body class="flex-container">



<section class="section" id="registro-section">
    
    <form method="post" onsubmit="return validarFormulario()">
        <h1 class="tex1">Registrarse</h1>
        <input type="text" id="nombre1" name="nombre" placeholder="Nombres" required></p>

        <input type="text" id="apellido1" name="apellido" placeholder="Apellidos" required></p>
        
        <input type="tel" id="tel1" name="telefono" placeholder="Telefono" required></p>
        
        <input type="email" id="correo1" name="correo" placeholder="Correo electrónico" required></p>
        
        <input type="text" id="usuario1" name="usuario" placeholder="Nombre de usuario" required></p>
        
        <input type="password" id="contrasena1" name="contrasena" placeholder="Contraseña" required></p>
        
        <input type="password" id="confirmar-contrasena" name="confirmar-contrasena" placeholder="Confirmar contraseña" required></p>
        <p id="mensajeRegistro"></p>

            <?php
                include("controlador/validar_registro.php");
            ?>
        <button class="registro-button" name="registrar">Registrarse</button>
    </form>
    <script src="JS/registro.js"></script>

    <section class="menu-section">
       <a class="menu-button" href="index.php">Inicio</a>
       <a class="menu-button " href="login.php">Iniciar Sesión</a>
    </section>

</section>
</body>
</html>
