<?php

include "conexion.php";

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = trim($_POST["nombre"] ?? "");
    $correo = trim($_POST["correo"] ?? "");
    $password = $_POST["password"] ?? "";

    if ($nombre == "" || !filter_var($correo, FILTER_VALIDATE_EMAIL)
        || strlen($password) < 6) {

        $mensaje = "Completa los datos correctamente. La contraseña debe tener al menos 6 caracteres.";

    } else {

        // Encriptar la contraseña
        $password_segura = password_hash($password, PASSWORD_DEFAULT);

        // Insertar usuario
        $sql = $conn->prepare(
            "INSERT INTO usuarios (nombre, correo, password)
             VALUES (?, ?, ?)"
        );

        $sql->bind_param(
            "sss",
            $nombre,
            $correo,
            $password_segura
        );

        if ($sql->execute()) {
            $mensaje = "Usuario registrado correctamente.";
        } else {
            $mensaje = "No se pudo registrar. Comprueba si el correo ya existe.";
        }

        $sql->close();
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de usuarios</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<div class="contenedor">

    <h1>Crear una cuenta</h1>

    <form method="POST">

        <label>Nombre:</label>
        <input type="text" name="nombre" required>

        <label>Correo:</label>
        <input type="email" name="correo" required>

        <label>Contraseña:</label>
        <input type="password" name="password"
               minlength="6" required>

        <button type="submit">Registrarse</button>

    </form>

    <p class="resultado">
        <?php echo htmlspecialchars($mensaje); ?>
    </p>

    <a href="login.php">Ir al inicio de sesión</a>

</div>

</body>
</html>
