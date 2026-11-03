
<?php

// Buscar las imágenes dentro de la carpeta
$imagenes = glob("imagenes/*.{jpg,jpeg,png,gif,webp}", GLOB_BRACE);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Mi galería de imágenes</title>

    <link rel="stylesheet" href="estilos.css">
</head>

<body>

<div class="contenedor">

    <h1>Mi galería de imágenes</h1>

    <p>Bienvenidos a mi colección de fotografías.</p>

    <div class="galeria">

        <?php foreach ($imagenes as $imagen): ?>

            <div class="imagen">

                <img src="<?php echo htmlspecialchars($imagen); ?>"
                     alt="Imagen de mi galería">

            </div>

        <?php endforeach; ?>

        <?php if (empty($imagenes)): ?>

            <p>No se encontraron imágenes.</p>

        <?php endif; ?>

    </div>

    <br>

    <a href="index.php">Volver al inicio</a>

</div>

</body>
</html>

