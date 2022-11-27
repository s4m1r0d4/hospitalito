<?php

include("conexionbd.php");

session_start();

if(isset($_GET['id']) && isset($_GET['tabla'])){
    $_SESSION['id'] = $_GET['id'];
    $_SESSION['tabla'] = $_GET['tabla'];
} else if(isset($_GET['op'])) {
    $tabla = $_SESSION['tabla'];
    $id    = $_SESSION['id'];

    if($_GET['op'] != 'si' or !isset($_SESSION['tabla'])
        or !isset($_SESSION['id'])) {
        header("Location: $tabla.php");
    }
    $sql   = "DELETE FROM $tabla WHERE id_$tabla = $id";
    echo $sql;

    try {
        $result = mysqli_query($conexion, $sql);
    } catch (Exception $e) {
        die($e->getMessage());
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
            <input type="radio" id="no" name="op" value="no">
            <label for="no">Si</label>
        </div>

            <input type="submit" value="Enviar">
        </div>
</main>

<?php include('includes/footer.php'); ?>
