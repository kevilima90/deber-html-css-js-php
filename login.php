<?php

session_start();

include "conexion.php";

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $correo = trim($_POST["correo"] ?? "");
    $password = $_POST["password"] ?? "";

    // Buscar al usuario por su correo
    $sql = $conn->prepare(
        "SELECT id, nombre, correo, password
         FROM usuarios WHERE correo = ?"
    );

    $sql->bind_param("s", $correo);
    $sql->execute();

    $resultado = $sql->get_result();

    if ($resultado->num_rows == 1) {

        // Obtener datos del usuario
        $usuario = $resultado->fetch_assoc();

        // Comprobar contraseña
        if (password_verify($password, $usuario["password"])) {

            session_regenerate_id(true);

            $_SESSION["usuario"] = [
                "id" => $usuario["id"],
                "nombre" => $usuario["nombre"],
                "correo" => $usuario["correo"]
            ];

            header("Location: login.php");
            exit();

        } else {

            $mensaje = "Contraseña incorrecta.";

        }

    } else {

        $mensaje = "El usuario no existe.";

    }

    $sql->close();
}

// Si ya inició sesión, mostrar bienvenida
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Login</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<div class="contenedor">

    <?php if (isset($_SESSION["usuario"])): ?>

        <h1>¡Bienvenido!</h1>

        <h2>
            <?php echo htmlspecialchars($_SESSION["usuario"]["nombre"]); ?>
        </h2>

        <p>Has iniciado sesión correctamente.</p>

        <p>Correo:
            <?php echo htmlspecialchars($_SESSION["usuario"]["correo"]); ?>
        </p>

        <a href="cerrar.php">Cerrar sesión</a>

    <?php else: ?>

        <h1>Iniciar sesión</h1>

        <form method="POST">

            <label>Correo electrónico:</label>

            <input type="email" name="correo" required>

            <label>Contraseña:</label>

            <input type="password" name="password" required>

            <button type="submit">Ingresar</button>

        </form>

        <p class="resultado">
            <?php echo htmlspecialchars($mensaje); ?>
        </p>

        <p>¿No tienes una cuenta?</p>

        <a href="registro.php">Registrarse</a>

    <?php endif; ?>

    <br><br>

    <a href="index.php">Volver al inicio</a>

</div>

</body>
</html>
