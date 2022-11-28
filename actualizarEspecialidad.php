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
$nombre = '';


if  (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM especialidad WHERE id_especialidad=$id";
    $res = mysqli_query($conexion, $sql);
    $fila = mysqli_fetch_array($res);
    $nombre = $fila['nombre'];
}


if (isset($_POST['actualizacion'])) {
  $id = $_GET['id'];
    $nombre= $_POST['especialidad'];

    $sql = "UPDATE especialidad set nombre = '$nombre' WHERE id_especialidad=$id";
    mysqli_query($conexion, $sql) or die ("No se realizó correctamente la actualizacion de los datos");
    header('Location: especialidad.php');
}

?>

<?php include('includes/header.php'); ?>
  <div class="container p-4">
    <div class="row">
      <div class="col-md-4 mx-auto">
        <div class="card card-body">
        <form action="actualizarEspecialidad.php?id=<?php echo $_GET['id']; ?>" method="POST">
          <div class="form-group">
            <input name="especialidad" type="text" class="form-control" value="<?php echo $nombre; ?>" placeholder="Actualizar especialidad"required>
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
