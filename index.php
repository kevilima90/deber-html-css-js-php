<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 1 - Menú desplegable</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<header>
    <h1>Mi página web</h1>

    <nav>
        <ul class="menu">
            <li><a href="index.php">Inicio</a></li>

            <li>
                <button onclick="mostrarMenu()" class="menu-boton">
                    Ejercicios ▼
                </button>

                <ul id="submenu" class="submenu">
                    <li><a href="contacto.php">Formulario</a></li>
                    <li><a href="contador.php">Contador</a></li>
                    <li><a href="juego.php">Adivinanzas</a></li>
                    <li><a href="galeria.php">Galería</a></li>
                    <li><a href="login.php">Login</a></li>
                </ul>
            </li>
        </ul>
    </nav>
</header>

<main class="contenedor">
    <h2>Bienvenido a mi proyecto</h2>
    <p>Esta página contiene los seis ejercicios de programación web.</p>

    <p>Selecciona una opción del menú para ingresar a cada ejercicio.</p>
</main>

<script>
function mostrarMenu() {
    let submenu = document.getElementById("submenu");

    if (submenu.style.display === "block") {
        submenu.style.display = "none";
    } else {
        submenu.style.display = "block";
    }
}
</script>

</body>
</html>
