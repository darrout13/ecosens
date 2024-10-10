<?php
session_start();
if(isset($_SESSION['exito_login']) && $_SESSION['exito_login']) {
    echo '<script>alert("Inicio de sesión exitoso");</script>';
    unset($_SESSION['exito_login']); // Limpiar la variable de sesión
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoSense - Iniciar Sesión</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="icon" href="img/LOGO.jpeg." type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&family=Open+Sans&family=Roboto&display=swap" rel="stylesheet">
    

</head>
<body>
    <section class="section" id="login-section">
        <form class="tamaño" method="post" action="controlador/validar_login.php">
            <h1 class="tex1">Iniciar Sesión</h1>
            <div class="input-container">
                <input type="text" id="usuario" name="usuario" placeholder="Usuario" required>
                <input type="password" id="contrasena" name="contrasena" placeholder="Contraseña" required>
            </div>
            <button type="submit" class="login-button">Ingresar</button>
            <?php if(isset($_SESSION['error_login'])) { ?>
                <p class="error"><?php echo $_SESSION['error_login']; ?></p>
                <?php unset($_SESSION['error_login']); ?>
            <?php } ?>
        </form>
        <section class="menu-section">
            <nav>
                <a href="index.php" class="menu-button">Inicio</a>
                <a href="registro.php" class="menu-button">Registrarse</a>
            </nav>
        </section>
    </section>
</body>
</html>