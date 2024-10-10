<?php
session_start(); // Inicia la sesión al principio del archivo

// Incluye el archivo de conexión
include('../controlador/conexion.php');

if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar los datos del formulario
    $nombre = $_POST['nombre'];
    $usuario= $_POST['usuario'];
    $apellidos = $_POST['apellidos'];
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    // Actualizar los datos del usuario en la base de datos
    if(isset($_SESSION['usuario'])) { // Verifica si $_SESSION['usuario'] está definido
        $id_usuario = $_SESSION['usuario'];

        // Si la contraseña no está vacía, se actualizará también
        if (!empty($contrasena)) {
            $sql = "UPDATE datos SET nombres = '$nombre', usuario = '$usuario', apellidos = '$apellidos', correo = '$correo', contraseña = '$contrasena' WHERE id_usuario = '$id_usuario'";
        } else {
            // Si la contraseña está vacía, no se actualizará
            $sql = "UPDATE datos SET nombres = '$nombre', apellidos = '$apellidos', correo = '$correo' WHERE usuario = '$id_usuario'";
        }

        // Ejecutar la consulta SQL
        $result = $conex->query($sql);
        
        if ($result === TRUE) {
            // Redirigir de vuelta a la página de información del usuario después de actualizar los datos
            header("location: ../info.php");
            exit;
        } else {
            // Manejar el caso en que ocurra un error al actualizar los datos
            echo "Error al actualizar los datos: " . $conex->error;
        }
    } else {
        echo "Error: La variable de sesión 'usuario' no está definida.";
    }
}


?>
