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