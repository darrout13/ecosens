<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario']; // Usuario ingresado en el formulario de login
    $contraseña = $_POST['contrasena']; // Contraseña ingresada en el formulario de login
    
    // Establecer la conexión a la base de datos con las credenciales correctas
    $conex = mysqli_connect("localhost", "root", "", "registros");

    if (!$conex) {
        die("Conexión fallida: " . mysqli_connect_error());
    }

    // Consulta preparada para prevenir inyección SQL
    $consulta = "SELECT id_usuario FROM datos WHERE usuario=? AND contraseña=?";
    $stmt = mysqli_prepare($conex, $consulta);
    mysqli_stmt_bind_param($stmt, "ss", $usuario, $contraseña);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt); // Obtener el resultado de la consulta preparada

    if ($fila = mysqli_fetch_assoc($result)) {
        // Las credenciales son válidas, redirigir a la página de inicio
        $_SESSION['usuario'] = $usuario; // Guardar el nombre de usuario en la sesión
        $_SESSION['id_usuario'] = $fila['id_usuario']; // Guardar el ID del usuario en la sesión

        // Enviar el ID de usuario a la API de Python local
        $url_api_python = 'http://localhost:5000/endpoint'; // Reemplaza con la URL de tu API de Python local y el puerto correcto
        $datos_api = array('id_usuario' => $fila['id_usuario']);
        $opciones = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($datos_api)
            )
        );
        $contexto = stream_context_create($opciones);
        $resultado_api = file_get_contents($url_api_python, false, $contexto);

        if ($resultado_api === FALSE) {
            // Manejar error aquí
        }

        mysqli_free_result($result);
        mysqli_close($conex);
        header("Location: /ECO_SENSE/inicio.php");
        exit(); // Asegurar que el script se detenga después de redirigir
    } else {
        // Las credenciales son incorrectas, establecer mensaje de error en una variable de sesión
        $_SESSION['error_login'] = "Usuario o contraseña incorrectos";
        mysqli_free_result($result);
        mysqli_close($conex);
        header("Location: /ECO_SENSE/login.php"); // Redirigir de vuelta al formulario de inicio de sesión
        exit();
    }
} else {
    // Si no se envió el formulario de inicio de sesión, redirigir al formulario de inicio de sesión
    header("Location: /ECO_SENSE/login.php");
    exit();
}
?>
