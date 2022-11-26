<?php include("conexionbd.php"); ?>

<?php include('includes/header.php'); ?>

<main class="container p-4">
  <div class="row">
    <div class="col-md-4">
      <div class="card card-body">
        <form action="insertar.php" method="POST">
          <div class="form-group">
            <input type="text" name="nombre_especialidad" class="form-control" placeholder="Especialidad" autofocus>
          </div>
          <input type="submit" name="tabla" class="btn btn-success btn-block" value="Registrar Especialidad">
        </form>
      </div>
    </div>
    <div class="col-md-8">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>ID</th>
            <th>Especialidad</th>
            <th>Operaciones</th>
          </tr>
        </thead>
        <tbody>

          <?php
          $sql = "SELECT * FROM Especialidad";
          $tabla = mysqli_query($conexion, $sql);    

          while($mostrar = mysqli_fetch_array($tabla)) { ?>
          <tr>
            <td><?php echo $mostrar['id_especialidad']; ?></td>
            <td><?php echo $mostrar['nombre']; ?></td>
            <td>
              <a href="actualizarEspecialidad.php?id=<?php echo $mostrar['id_especialidad']?>" class="btn btn-secondary">
                <i class="fas fa-marker"></i>
              </a>
              <a href="eliminar.php?id=<?php echo $mostrar['id_especialidad']?>&tabla=especialidad" class="btn btn-danger">
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