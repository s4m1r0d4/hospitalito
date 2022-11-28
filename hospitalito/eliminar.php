<?php
    if (session_status() === PHP_SESSION_NONE) session_start();
    if (!isset($_SESSION['loggedin']) or $_SESSION['loggedin'] != true
        or isset($_GET["cerrar_sesion"])) {
        $_SESSION['loggedin'] = false;
        header("location: inicio.php");
        exit;
    }
?>

<?php

include("conexionbd.php");

if (isset($_GET['id']) && isset($_GET['tabla'])){
    $_SESSION['id']    = $_GET['id'];
    $_SESSION['tabla'] = $_GET['tabla'];
} else if (isset($_GET['op'])) {
    $id    = $_SESSION['id'];
    $tabla = $_SESSION['tabla'];

    if (!isset($_SESSION['tabla']) or !isset($_SESSION['id'])) {
        header("Location: tablas.php");
    }

    if ($_GET['op'] === 'si') {
        $sql = "DELETE FROM $tabla WHERE id_$tabla = $id";
        try {
            $result = mysqli_query($conexion, $sql);
        } catch (Exception $e) {
            die($e->getMessage());
        }
        echo 'elimina you puto';
    }

    header("Location: $tabla.php");
} else {
    header("Location: tablas.php");
}
?>

<?php include('includes/header.php'); ?>

<main class="container p-4">
    <h2>¿Está seguro de eliminar el dato?</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
         method="get">
        <div>
            <input type="radio" id="no" name="op" value="no"
             checked>
            <label for="no">No</label>
        </div>

        <div>
            <input type="radio" id="si" name="op" value="si">
            <label for="si">Si</label>
        </div>

            <input type="submit" value="Enviar">
        </div>
</main>

<?php include('includes/footer.php'); ?>
