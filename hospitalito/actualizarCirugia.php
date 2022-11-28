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
    $sql = "SELECT * FROM cirugia WHERE id_cirugia=$id";
    $res = mysqli_query($conexion, $sql);
    $fila = mysqli_fetch_array($res);
    $paciente= $fila['id_paciente'];
    $doctor= $fila['id_doctor'];
    $fechaini= $fila['fechaini'];
    $sala= $fila['id_sala'];
}

if (isset($_POST['actualizacion'])) {
    $id = $_GET['id'];
    $paciente= $_REQUEST['paciente_cirugia'];
    $doctor= $_REQUEST['doctor_cirugia'];
    $fechaini= $_REQUEST['fechaini_cirugia'];
    $sala= $_REQUEST['sala_cirugia'];
    $sql = "UPDATE cirugia set id_paciente='$paciente', id_doctor='$doctor', fechaini='$fechaini', id_sala='$sala' where id_cirugia=$id";
    mysqli_query($conexion, $sql) or die ("No se realizó correctamente la actualizacion de los datos");
    header('Location: cirugia.php');
}
?>

<?php include('includes/header.php'); ?>
  <div class="container p-4">
    <div class="row">
      <div class="col-md-4 mx-auto">
        <div class="card card-body">
        <form action="actualizarCirugia.php?id=<?php echo $_GET['id']; ?>" method="POST">
          <div class="form-group">
            <?php
             $sql = "select id_paciente,concat(paciente.nombre,' ',paciente.apep,' ',paciente.apem) as paciente from paciente where id_paciente>$paciente or id_paciente<$paciente";
             $tabla = mysqli_query($conexion, $sql);
             //Obtener nombre del paciente ingresado anteriormente
             $obtenerNombre="select id_paciente,concat(paciente.nombre,' ',paciente.apep,' ',paciente.apem) as paciente from paciente where id_paciente=$paciente";
             $nombrePaciente=mysqli_query($conexion,$obtenerNombre);
             $nombrePaciente=mysqli_fetch_array($nombrePaciente);
              ?>
             Paciente: <SELECT NAME="paciente_cirugia">
              <OPTION VALUE= <?php echo $paciente ?> SELECTED><?php echo $nombrePaciente['paciente']?>
             <?php  while($mostrar=mysqli_fetch_array($tabla)){   ?>
                <OPTION VALUE= <?php echo $mostrar['id_paciente'] ?> ><?php echo $mostrar['paciente']?>
             <?php }?>
            </SELECT>
          </div>
           <div class="form-group">
            <?php
             $sql = "select id_doctor,concat(doctor.nombre,' ',doctor.apep,' ',doctor.apem) as doctor from doctor where id_doctor>$doctor or id_doctor<$doctor";
             $tabla = mysqli_query($conexion, $sql);
             //Obtener nombre del doctor ingresado anteriormente
             $obtenerNombre="select id_doctor,concat(doctor.nombre,' ',doctor.apep,' ',doctor.apem) as doctor from doctor where id_doctor=$doctor";
             $nombreDoctor=mysqli_query($conexion,$obtenerNombre);
             $nombreDoctor=mysqli_fetch_array($nombreDoctor);
              ?>
             Doctor: <SELECT NAME="doctor_cirugia">
              <OPTION VALUE= <?php echo $doctor ?> SELECTED><?php echo $nombreDoctor['doctor']?>
             <?php  while($mostrar=mysqli_fetch_array($tabla)){   ?>
                <OPTION VALUE= <?php echo $mostrar['id_doctor'] ?> ><?php echo $mostrar['doctor']?>
             <?php }?>
            </SELECT>
          </div>
          <div class="form-group">
            <?php
             $sql = "select * from sala where id_sala>$sala or id_sala<$sala";
             $tabla = mysqli_query($conexion, $sql);
             //Obtener nombre de la sala ingresada anteriormente
             $obtenerNombre="select *from sala where id_sala=$sala";
             $nombreSala=mysqli_query($conexion,$obtenerNombre);
             $nombreSala=mysqli_fetch_array($nombreSala);
             ?>
             Sala: <SELECT NAME="sala_cirugia">
              <OPTION VALUE= <?php echo $sala ?> SELECTED><?php echo $nombreSala['NOMBRE']?>
             <?php  while($mostrar=mysqli_fetch_array($tabla)){   ?>
                <OPTION VALUE= <?php echo $mostrar['id_sala'] ?> ><?php echo $mostrar['NOMBRE']?>
             <?php }?>
            </SELECT>
          </div>
          <div class="form-group">
            Fecha de inicio: <input type="datetime-local" name="fechaini_cirugia" value="<?php echo $fechaini; ?>" class="form-control" placeholder="Fecha de inicio" required>
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
