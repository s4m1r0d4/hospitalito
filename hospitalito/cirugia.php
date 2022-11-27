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
             Paciente: <SELECT NAME="paciente_cirugia"> 
             <?php  while($mostrar=mysqli_fetch_array($tabla)){   ?>
                <OPTION VALUE= <?php echo $mostrar['id_paciente'] ?> SELECTED><?php echo $mostrar['paciente']?>
             <?php }?>
            </SELECT>
          </div>
          <div class="form-group">
            <?php
             $sql = "select id_doctor,concat(doctor.nombre,' ',doctor.apep,' ',doctor.apem) as doctor from doctor";
             $tabla = mysqli_query($conexion, $sql); ?>  
             Doctor: <SELECT NAME="doctor_cirugia"> 
             <?php  while($mostrar=mysqli_fetch_array($tabla)){   ?>
                <OPTION VALUE= <?php echo $mostrar['id_doctor'] ?> SELECTED><?php echo $mostrar['doctor']?>
             <?php }?>
            </SELECT>
          </div>
          <div class="form-group">
            <?php
             $sql = "select * from sala";
             $tabla = mysqli_query($conexion, $sql); ?>  
             Sala: <SELECT NAME="sala_cirugia"> 
             <?php  while($mostrar=mysqli_fetch_array($tabla)){   ?>
                <OPTION VALUE= <?php echo $mostrar['id_sala'] ?> SELECTED><?php echo $mostrar['NOMBRE']?>
             <?php }?>
            </SELECT>
          </div>
          <div class="form-group">
            Fecha de inicio: <input type="datetime-local" name="fechaini_cirugia" class="form-control" placeholder="Fecha de inicio" required>
          </div>      

          <input type="submit" name="tabla" class="btn btn-success btn-block" value="Registrar Cirugia">
        </form>
      </div>
    </div>
    <div class="col-md-8">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>ID</th>
            <th>Paciente</th>
            <th>Doctor</th>
            <th>Sala</th>
            <th>Fecha de inicio</th>
            <th>Operaciones</th>
          </tr>
        </thead>
        <tbody>

          <?php
          $sql = " select id_cirugia, concat(paciente.nombre,' ',paciente.apep,' ',paciente.apem) as paciente, concat(doctor.nombre,' ',doctor.apep,' ',doctor.apem)as doctor, sala.nombre as sala, fechaini from cirugia inner join paciente on cirugia.id_paciente=paciente.id_paciente inner join doctor on cirugia.id_doctor=doctor.id_doctor inner join sala on cirugia.id_sala=sala.id_sala;";
          $tabla = mysqli_query($conexion, $sql);    

          while($mostrar = mysqli_fetch_array($tabla)) { ?>
          <tr>
            <td><?php echo $mostrar['id_cirugia']; ?></td>
            <td><?php echo $mostrar['paciente']; ?></td>
            <td><?php echo $mostrar['doctor']; ?></td>
            <td><?php echo $mostrar['sala']; ?></td>
            <td><?php echo $mostrar['fechaini']; ?></td>
            <td>
              <a href="actualizarCirugia.php?id=<?php echo $mostrar['id_cirugia']?>" class="btn btn-secondary">
                <i class="fas fa-marker"></i>
              </a>
              <a href="eliminar.php?id=<?php echo $mostrar['id_cirugia']?>&tabla=cirugia" class="btn btn-danger">
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