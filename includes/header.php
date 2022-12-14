<?php
    if (session_status() === PHP_SESSION_NONE) session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Hospitalito CRUD</title>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <!-- BOOTSTRAP 4 -->
        <link rel="stylesheet" href="https://bootswatch.com/4/yeti/bootstrap.min.css">
        <!-- FONT AWESOEM -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    </head>
    <body>
        <nav class="navbar navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="tablas.php">Hospitalito</a>
            </div>
            <?php
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                $conexion = mysqli_connect("localhost","root","","hospitalito")
                    or die ("No se ha podido conectar  al servidor de la base de datos");

                $db = mysqli_select_db($conexion, "hospitalito")
                    or die("No se ha podido conectar con la base de datos");
                // Encontrar el nombre de usuario
                $id = $_SESSION['id_cuenta'];
                $sql = "SELECT usuario FROM cuenta WHERE id_cuenta = $id";
                $res = mysqli_query($conexion, $sql);
                $row = $res->fetch_array(MYSQLI_ASSOC);
                $usuario = $row['usuario'];


                echo '<h4 style="color:white;">' . $usuario . '</h4>&nbsp;';
                echo '<div>';
                echo '    <form method="get">';
                echo '        <input type="submit" name="cerrar_sesion"';
                echo '            value="Cerrar sesión" />';
                echo '    </form>';
                echo '</div>';
            }
            ?>
        </nav>
