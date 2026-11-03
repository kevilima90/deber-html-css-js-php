<?php
session_start();

// Generar el número aleatorio al iniciar el juego
if (!isset($_SESSION["numero"])) {
    $_SESSION["numero"] = rand(1, 10);
    $_SESSION["intentos"] = 0;
}

$resultado = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $respuesta = $_POST["numero"] ?? "";

    if (filter_var($respuesta, FILTER_VALIDATE_INT) === false ||
        $respuesta < 1 || $respuesta > 10) {

        $resultado = "Ingresa un número entre 1 y 10.";

    } else {

        $_SESSION["intentos"]++;

        if ($respuesta == $_SESSION["numero"]) {

            $resultado = "¡Felicidades! Adivinaste el número.";

            // Reiniciar para una nueva partida
            unset($_SESSION["numero"]);
            unset($_SESSION["intentos"]);

        } else {

            $resultado = "No acertaste. ¡Inténtalo nuevamente!";

        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Juego de adivinanzas</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<div class="contenedor">
    <h1>Juego de adivinanzas</h1>

    <p>Estoy pensando en un número del 1 al 10.</p>

    <form method="POST" onsubmit="return validarNumero()">

        <label>¿Cuál es el número?</label>

        <input type="number" id="numero" name="numero"
               min="1" max="10" required>

        <button type="submit">Adivinar</button>

    </form>

    <p id="error" class="resultado"></p>

    <h3>
        <?php echo htmlspecialchars($resultado); ?>
    </h3>

    <?php if (isset($_SESSION["intentos"])): ?>
        <p>Intentos realizados: <?php echo $_SESSION["intentos"]; ?></p>
    <?php endif; ?>

    <a href="juego.php">Nueva partida</a>
    <br><br>
    <a href="index.php">Volver al inicio</a>
</div>

<script>
function validarNumero() {

    let numero = document.getElementById("numero").value;

    if (numero === "" || numero < 1 || numero > 10) {
        document.getElementById("error").innerHTML =
            "Debes ingresar un número entre 1 y 10.";

        return false;
    }

    return true;
}
</script>

</body>
</html>
