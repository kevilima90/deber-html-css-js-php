<?php
$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = trim($_POST["nombre"] ?? "");
    $correo = trim($_POST["correo"] ?? "");
    $texto = trim($_POST["mensaje"] ?? "");

    if ($nombre != "" && filter_var($correo, FILTER_VALIDATE_EMAIL) && $texto != "") {
        $mensaje = "¡Formulario enviado correctamente! Gracias " .
                   htmlspecialchars($nombre);
    } else {
        $mensaje = "Por favor, verifica los datos ingresados.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de contacto</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<div class="contenedor">
    <h1>Formulario de contacto</h1>

    <form method="POST" onsubmit="return validarFormulario()">

        <label>Nombre:</label>
        <input type="text" id="nombre" name="nombre"
               placeholder="Escribe tu nombre">

        <label>Correo electrónico:</label>
        <input type="email" id="correo" name="correo"
               placeholder="ejemplo@gmail.com">

        <label>Mensaje:</label>
        <textarea id="mensaje" name="mensaje"
                  placeholder="Escribe tu mensaje"></textarea>

        <button type="submit">Enviar formulario</button>
    </form>

    <p id="error" class="resultado"></p>

    <?php if ($mensaje != ""): ?>
        <p class="resultado">
            <?php echo $mensaje; ?>
        </p>
    <?php endif; ?>

    <a href="index.php">Volver al inicio</a>
</div>

<script>
function validarFormulario() {

    let nombre = document.getElementById("nombre").value.trim();
    let correo = document.getElementById("correo").value.trim();
    let mensaje = document.getElementById("mensaje").value.trim();

    let error = document.getElementById("error");

    if (nombre === "") {
        error.innerHTML = "Debes ingresar tu nombre.";
        return false;
    }

    if (correo === "") {
        error.innerHTML = "Debes ingresar tu correo.";
        return false;
    }

    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(correo)) {
        error.innerHTML = "Ingresa un correo válido.";
        return false;
    }

    if (mensaje === "") {
        error.innerHTML = "Debes escribir un mensaje.";
        return false;
    }

    return true;
}
</script>

</body>
</html>
