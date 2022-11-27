<?php include("conexionbd.php"); ?>

<?php include('includes/header.php'); ?>

<main class="container p-4">
  <div class="row">
    <div class="col-md-4">
      <div class="card card-body">
        <form action="insertar.php" method="POST">
          <div class="form-group">
            <input type="text" name="nombre_paciente" class="form-control" placeholder="Nombre" autofocus required>
          </div>
          <div class="form-group">
            <input type="text" name="apep_paciente" class="form-control" placeholder="Apellido paterno" required>
          </div>
          <div class="form-group">
            <input type="text" name="apem_paciente" class="form-control" placeholder="Apellido materno" required>
          </div>
          <div class="form-group">
            <input type="text" name="domicilio_paciente" class="form-control" placeholder="Domicilio" required>
          </div>
          <div class="form-group">
            <input type="date" name="fechana_paciente" class="form-control" placeholder="Fecha de nacimiento" required>
          </div>
          <div class="form-group">
            <input type="number" name="celular_paciente" class="form-control" placeholder="Celular" maxlength="10" required>
          </div>

          <div class="form-check">
            <input type="radio" class="form-check-input" name="sexo_paciente" class="form-control" required VALUE="M">Hombre
          </div>
          <div class="form-check">
            <input type="radio" class="form-check-input" name="sexo_paciente" class="form-control" required VALUE="F">Mujer
          </div>

          <input type="submit" name="tabla" class="btn btn-success btn-block" value="Registrar Paciente">
        </form>
      </div>
    </div>
    <div class="col-md-8">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>Sexo</th>
            <th>Domicilio</th>
            <th>Fecha de nacimiento</th>
            <th>Celular</th>
            <th>Operaciones</th>
          </tr>
        </thead>
        <tbody>

          <?php
          $sql = "SELECT * FROM paciente";
          $tabla = mysqli_query($conexion, $sql);    

          while($mostrar = mysqli_fetch_array($tabla)) { ?>
          <tr>
            <td><?php echo $mostrar['id_paciente']; ?></td>
            <td><?php echo $mostrar['nombre']; ?></td>
            <td><?php echo $mostrar['apep']; ?></td>
            <td><?php echo $mostrar['apem']; ?></td>
            <td><?php echo $mostrar['sexo']; ?></td>
            <td><?php echo $mostrar['domicilio']; ?></td>
            <td><?php echo $mostrar['fechana']; ?></td>
            <td><?php echo $mostrar['celular']; ?></td>
            <td>
              <a href="actualizarPaciente.php?id=<?php echo $mostrar['id_paciente']?>" class="btn btn-secondary">
                <i class="fas fa-marker"></i>
              </a>
              <a href="eliminar.php?id=<?php echo $mostrar['id_paciente']?>&tabla=paciente" class="btn btn-danger">
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