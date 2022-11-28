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
            <?php
             $sql = "select id_paciente,concat(paciente.nombre,' ',paciente.apep,' ',paciente.apem) as paciente from paciente";
             $tabla = mysqli_query($conexion, $sql); ?>
             Paciente: <SELECT NAME="paciente_receta">
             <?php  while($mostrar=mysqli_fetch_array($tabla)){   ?>
                <OPTION VALUE= <?php echo $mostrar['id_paciente'] ?> SELECTED><?php echo $mostrar['paciente']?>
             <?php }?>
            </SELECT>
          </div>
          <div class="form-group">
            <?php
             $sql = "select * from medicamento";
             $tabla = mysqli_query($conexion, $sql); ?>
             Medicamento: <SELECT NAME="medicamento_receta">
             <?php  while($mostrar=mysqli_fetch_array($tabla)){   ?>
                <OPTION VALUE= <?php echo $mostrar['id_medicamento'] ?> SELECTED><?php echo $mostrar['nombre']?>
             <?php }?>
            </SELECT>
          </div>
          <div class="form-group">
            Fecha de inicio: <input type="date" name="fechaini_receta" class="form-control" placeholder="Fecha de inicio" required>
          </div>
          <div class="form-group">
            Fecha de fin: <input type="date" name="fechafin_receta" class="form-control" placeholder="Fecha de fin" required>
          </div>
          <div class="form-group">
            <input type="number" name="dosis" class="form-control" placeholder="Dosis" maxlength="5" required>
          </div>


          <input type="submit" name="tabla" class="btn btn-success btn-block" value="Registrar Receta">
        </form>
      </div>
    </div>
    <div class="col-md-8">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>ID</th>
            <th>Paciente</th>
            <th>Medicamento</th>
            <th>Dosis</th>
            <th>Fecha de inicio</th>
            <th>Fecha de fin</th>
            <th>Operaciones</th>
          </tr>
        </thead>
        <tbody>

          <?php
          $sql = "select id_receta,concat(paciente.nombre,' ',paciente.apep,' ',paciente.apem) as paciente,medicamento.nombre as medicamento,dosis,fechaini,fechafin from receta inner join paciente on receta.id_paciente=paciente.id_paciente inner join medicamento on receta.id_medicamento=medicamento.id_medicamento";
          $tabla = mysqli_query($conexion, $sql);

          while($mostrar = mysqli_fetch_array($tabla)) { ?>
          <tr>
            <td><?php echo $mostrar['id_receta']; ?></td>
            <td><?php echo $mostrar['paciente']; ?></td>
            <td><?php echo $mostrar['medicamento']; ?></td>
            <td><?php echo $mostrar['dosis']; ?></td>
            <td><?php echo $mostrar['fechaini']; ?></td>
            <td><?php echo $mostrar['fechafin']; ?></td>
            <td>
              <a href="actualizarReceta.php?id=<?php echo $mostrar['id_receta']?>" class="btn btn-secondary">
                <i class="fas fa-marker"></i>
              </a>
              <a href="eliminar.php?id=<?php echo $mostrar['id_receta']?>&tabla=receta" class="btn btn-danger">
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
