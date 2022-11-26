<?php

session_start();

if (isset($_SESSION['loggedin']) and $_SESSION['loggedin'] != true
    or isset($_GET["cerrar_sesion"])) {
    $_SESSION['loggedin'] = false;
    header("location: inicio.php");
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Página principal</title>
</head>
<body>
    <h1>Hospitalito</h1>
    <h2 class="my-5">Bienvenido, <b>
        <?php echo htmlspecialchars($_SESSION["usuario"]); ?> </h2>
        <p>
            <form method="get">
                <input type="submit" name="cerrar_sesion"
                    value="Cerrar sesión" />
            </form>
        </p>
</body>
</html>
