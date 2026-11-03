<?php

$servidor = "localhost";
$usuario = "root";
$password = "";
$base_datos = "deber_web";

// Crear conexión
$conn = new mysqli(
    $servidor,
    $usuario,
    $password,
    $base_datos
);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");

?>
