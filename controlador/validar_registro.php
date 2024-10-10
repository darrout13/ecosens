<?php
include("conexion.php");

$mostrarMensaje = false; // Variable de bandera para controlar si se muestra el mensaje de error

if (isset($_POST["registrar"])) {
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $telefono = trim($_POST['telefono']);
    $correo = trim($_POST['correo']);
    $usuario = trim($_POST['usuario']);
    $contrasena = trim($_POST['contrasena']);
    $fecha_reg = date("Y-m-d"); // Formato de fecha y hora

    if (
        strlen($nombre) >= 1 &&
        strlen($apellido) >= 1 &&
        strlen($telefono) >= 1 &&
        filter_var($correo, FILTER_VALIDATE_EMAIL) &&
        strlen($usuario) >= 1 &&
        strlen($contrasena) >= 1
    ) {
        // Verificar si el correo y el usuario ya existen
        $consulta_existencia = "SELECT * FROM datos WHERE correo = '$correo' OR usuario = '$usuario'";
        $resultado_existencia = mysqli_query($conex, $consulta_existencia);

        if (mysqli_num_rows($resultado_existencia) == 0) {
            // El correo y el usuario no existen, procede con la inserción

            // Inserción segura
            $consulta_insercion = "INSERT INTO datos (nombres, apellidos, correo, telefono, usuario, contraseña, fech_registro) VALUES ('$nombre', '$apellido', '$correo', '$telefono', '$usuario', '$contrasena', '$fecha_reg')";

            if (mysqli_query($conex, $consulta_insercion)) {
                // Mostrar alerta de registro exitoso
                echo '<script>alert("Te has registrado correctamente. Serás redirigido a la página de inicio de sesión."); window.location = "login.php";</script>';
                exit; // Asegura que no se ejecuten más instrucciones después de la redirección
            } else {
                // Mostrar alerta de error en la inserción
                echo '<script>alert("Ha ocurrido un error al registrar. Por favor, inténtalo de nuevo.");</script>';
            }
        } else {
            // El correo o el usuario ya están registrados, establecer la variable de bandera
            $mostrarMensaje = true;
        }
    } else {
        // Mostrar alerta de campos incompletos o incorrectos
        echo '<script>alert("Por favor complete los campos correctamente.");</script>';
    }
}

// Mostrar el mensaje de error solo si la variable de bandera está establecida en verdadero
if ($mostrarMensaje) {
    echo '<script>alert("El correo electrónico o el nombre de usuario ya están registrados.");</script>';
}
?>
