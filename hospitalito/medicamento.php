<?php
    if (session_status() === PHP_SESSION_NONE) session_start();
    if (!isset($_SESSION['loggedin']) or $_SESSION['loggedin'] != true
        or isset($_GET["cerrar_sesion"])) {
        $_SESSION['loggedin'] = false;
        header("location: inicio.php");
        exit;
    }
?>
<?php include("conexionbd.php"); ?>

<?php include('includes/header.php'); ?>

<main class="container p-4">
  <div class="row">
    <div class="col-md-4">
      <div class="card card-body">
        <form action="insertar.php" method="POST">
          <div class="form-group">
            <input type="text" name="nombre_medicamento" class="form-control" placeholder="Medicamento" autofocus required>
          </div>
          <input type="submit" name="tabla" class="btn btn-success btn-block" value="Registrar Medicamento">
        </form>
      </div>
    </div>
    <div class="col-md-8">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>ID</th>
            <th>Medicamento</th>
            <th>Operaciones</th>
          </tr>
        </thead>
        <tbody>

          <?php
          $sql = "SELECT * FROM medicamento";
          $tabla = mysqli_query($conexion, $sql);

          while($mostrar = mysqli_fetch_array($tabla)) { ?>
          <tr>
            <td><?php echo $mostrar['id_medicamento']; ?></td>
            <td><?php echo $mostrar['nombre']; ?></td>
            <td>
              <a href="actualizarMedicamento.php?id=<?php echo $mostrar['id_medicamento']?>" class="btn btn-secondary">
                <i class="fas fa-marker"></i>
              </a>
              <a href="eliminar.php?id=<?php echo $mostrar['id_medicamento']?>&tabla=medicamento" class="btn btn-danger">
                <i class="far fa-trash-alt"></i>
              </a>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</main>

<?php include('includes/footer.php'); ?>
