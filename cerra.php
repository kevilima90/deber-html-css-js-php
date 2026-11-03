<?php

session_start();

// Eliminar los datos de sesión
$_SESSION = [];

// Destruir la sesión
session_destroy();

// Regresar al login
header("Location: login.php");
exit();

?>
