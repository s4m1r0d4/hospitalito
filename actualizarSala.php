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

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM sala WHERE id_sala=$id";
    $res = mysqli_query($conexion, $sql);
    $fila = mysqli_fetch_array($res);
    $nombre = $fila['NOMBRE'];
}

if (isset($_POST['actualizacion'])) {
  $id = $_GET['id'];
    $nombre= $_POST['sala'];
    $sql = "UPDATE sala set nombre = '$nombre' WHERE id_sala=$id";
    mysqli_query($conexion, $sql) or die ("No se realizó correctamente la actualizacion de los datos");
    header('Location: sala.php');
}
?>
<?php include('includes/header.php'); ?>
  <div class="container p-4">
    <div class="row">
      <div class="col-md-4 mx-auto">
        <div class="card card-body">
        <form action="actualizarSala.php?id=<?php echo $_GET['id']; ?>" method="POST">
          <div class="form-group">
            <input name="sala" type="text" class="form-control" value="<?php echo $nombre; ?>" placeholder="Actualizar Sala" required>
          </div>
          <div class="form-group">
          </div>
          <button class="btn-success" name="actualizacion">
            Actualizar
  </button>
        </form>
        </div>
      </div>
    </div>
  </div>
<?php include('includes/footer.php'); ?>
