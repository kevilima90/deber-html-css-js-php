<?php

$archivo = "visitas.txt";

// Abrir el archivo para leer y escribir
$contador = fopen($archivo, "c+");

if ($contador === false) {
    die("No se pudo abrir el archivo.");
}

// Bloquear el archivo mientras se actualiza
flock($contador, LOCK_EX);

// Leer el número de visitas
$visitas = (int) file_get_contents($archivo);

// Aumentar una visita
$visitas++;

// Regresar al inicio del archivo
rewind($contador);

// Guardar el nuevo número
ftruncate($contador, 0);
fwrite($contador, $visitas);

// Desbloquear y cerrar
flock($contador, LOCK_UN);
fclose($contador);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contador de visitas</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<div class="contenedor">
    <h1>Contador de visitas</h1>

    <p>Bienvenido a mi página web.</p>

    <h2>Esta página ha sido visitada:</h2>

    <h1 class="numero">
        <?php echo $visitas; ?>
    </h1>

    <p>veces.</p>

    <a href="index.php">Volver al inicio</a>
</div>

</body>
</html>
