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
    $sql = "SELECT * FROM receta WHERE id_receta=$id";
    $res = mysqli_query($conexion, $sql);
    $fila = mysqli_fetch_array($res);
    $paciente= $fila['id_paciente'];
    $medicamento= $fila['id_medicamento'];
    $fechaini= $fila['fechaini'];
    $fechafin= $fila['fechafin'];
    $dosis= $fila['dosis'];

}

if (isset($_POST['actualizacion'])) {
    $id = $_GET['id'];
    $paciente= $_REQUEST['paciente_receta'];
    $medicamento= $_REQUEST['medicamento_receta'];
    $fechaini= $_REQUEST['fechaini_receta'];
    $fechafin= $_REQUEST['fechafin_receta'];
    $dosis= $_REQUEST['dosis'];
    $sql = "UPDATE receta set id_paciente='$paciente', id_medicamento='$medicamento', fechaini='$fechaini', fechafin='$fechafin', dosis='$dosis' where id_receta=$id";
    mysqli_query($conexion, $sql) or die ("No se realizó correctamente la actualizacion de los datos");
    header('Location: receta.php');
}
?>
<?php include('includes/header.php'); ?>
  <div class="container p-4">
    <div class="row">
      <div class="col-md-4 mx-auto">
        <div class="card card-body">
        <form action="actualizarReceta.php?id=<?php echo $_GET['id']; ?>" method="POST">
          <div class="form-group">
            <?php
             $sql = "select id_paciente,concat(paciente.nombre,' ',paciente.apep,' ',paciente.apem) as paciente from paciente where id_paciente>$paciente or id_paciente<$paciente";
             $tabla = mysqli_query($conexion, $sql);
             //Obtener nombre del paciente ingresado anteriormente
             $obtenerNombre="select id_paciente,concat(paciente.nombre,' ',paciente.apep,' ',paciente.apem) as paciente from paciente where id_paciente=$paciente";
             $nombrePaciente=mysqli_query($conexion,$obtenerNombre);
             $nombrePaciente=mysqli_fetch_array($nombrePaciente);
              ?>
             Paciente: <SELECT NAME="paciente_receta">
              <OPTION VALUE= <?php echo $paciente ?> SELECTED><?php echo $nombrePaciente['paciente']?>
             <?php  while($mostrar=mysqli_fetch_array($tabla)){   ?>
                <OPTION VALUE= <?php echo $mostrar['id_paciente'] ?> ><?php echo $mostrar['paciente']?>
             <?php }?>
            </SELECT>
          </div>
          <div class="form-group">
            <?php
             $sql = "select * from medicamento where id_medicamento>$medicamento or id_medicamento<$medicamento";
             $tabla = mysqli_query($conexion, $sql);
             //Obtener nombre del medicamento ingresado anteriormente
             $obtenerNombre="select *from medicamento where id_medicamento=$medicamento";
             $nombreMedicamento=mysqli_query($conexion,$obtenerNombre);
             $nombreMedicamento=mysqli_fetch_array($nombreMedicamento);
             ?>
             Medicamento: <SELECT NAME="medicamento_receta">
              <OPTION VALUE= <?php echo $paciente ?> SELECTED><?php echo $nombreMedicamento['nombre']?>
             <?php  while($mostrar=mysqli_fetch_array($tabla)){   ?>
                <OPTION VALUE= <?php echo $mostrar['id_medicamento'] ?> ><?php echo $mostrar['nombre']?>
             <?php }?>
            </SELECT>
          </div>
          <div class="form-group">
            Fecha de inicio: <input type="date" name="fechaini_receta" value="<?php echo $fechaini; ?>" class="form-control" placeholder="Fecha de inicio" required>
          </div>
          <div class="form-group">
            Fecha de fin: <input type="date" name="fechafin_receta" value="<?php echo $fechafin; ?>" class="form-control" placeholder="Fecha de fin" required>
          </div>
          <div class="form-group">
            <input type="numberDecimal" name="dosis" class="form-control" value="<?php echo $dosis; ?>" placeholder="Dosis" maxlength="5" required>
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
