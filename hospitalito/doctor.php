<?php include("conexionbd.php"); ?>

<?php include('includes/header.php'); ?>

<main class="container p-4">
  <div class="row">
    <div class="col-md-3">
      <div class="card card-body">
        <form action="insertar.php" method="POST">
          <div class="form-group">
            <input type="text" name="nombre_doctor" class="form-control" placeholder="Nombre" autofocus required>
          </div>
          <div class="form-group">
            <input type="text" name="apep_doctor" class="form-control" placeholder="Apellido paterno" required>
          </div>
          <div class="form-group">
            <input type="text" name="apem_doctor" class="form-control" placeholder="Apellido materno" required>
          </div>
          <div class="form-group">
            <input type="text" name="domicilio_doctor" class="form-control" placeholder="Domicilio" required>
          </div>
          <div class="form-group">
            <input type="date" name="fechana_doctor" class="form-control" placeholder="Fecha de nacimiento" required>
          </div>
          <div class="form-group">
            <input type="number" name="celular_doctor" class="form-control" placeholder="Celular" maxlength="10" required>
          </div>
          <div class="form-group">
            <?php
             $sql = "SELECT * FROM especialidad";
             $tabla = mysqli_query($conexion, $sql); ?>  
             Especialidad: <SELECT NAME="especialidad_doctor"> 
             <?php  while($mostrar=mysqli_fetch_array($tabla)){   ?>
                <OPTION VALUE= <?php echo $mostrar['id_especialidad'] ?> SELECTED><?php echo $mostrar['nombre']?>
             <?php }?>
            </SELECT>
            
          </div>

          <div class="form-check">
            <input type="radio" class="form-check-input" name="sexo_doctor" class="form-control" required VALUE="M">Hombre
          </div>
          <div class="form-check">
            <input type="radio" class="form-check-input" name="sexo_doctor" class="form-control" required VALUE="F">Mujer
          </div>

          <input type="submit" name="tabla" class="btn btn-success btn-block" value="Registrar Doctor">
        </form>
      </div>
    </div>
    <div class="col-md-8">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>ID</th>
            <th>Especialidad</th>
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
          $sql = "select id_doctor,doctor.nombre, apep, apem, sexo, domicilio,fechana,celular,especialidad.nombre as especialidad from doctor inner join especialidad on doctor.id_especialidad=especialidad.id_especialidad";
          $tabla = mysqli_query($conexion, $sql);    

          while($mostrar = mysqli_fetch_array($tabla)) { ?>
          <tr>
            <td><?php echo $mostrar['id_doctor']; ?></td>
            <td><?php echo $mostrar['especialidad']; ?></td>
            <td><?php echo $mostrar['nombre']; ?></td>
            <td><?php echo $mostrar['apep']; ?></td>
            <td><?php echo $mostrar['apem']; ?></td>
            <td><?php echo $mostrar['sexo']; ?></td>
            <td><?php echo $mostrar['domicilio']; ?></td>
            <td><?php echo $mostrar['fechana']; ?></td>
            <td><?php echo $mostrar['celular']; ?></td>
            <td>
              <a href="actualizarDoctor.php?id=<?php echo $mostrar['id_doctor']?>" class="btn btn-secondary">
                <i class="fas fa-marker"></i>
              </a>
              <a href="eliminar.php?id=<?php echo $mostrar['id_doctor']?>&tabla=doctor" class="btn btn-danger">
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