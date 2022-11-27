<?php
include("conexionbd.php");



if  (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM paciente WHERE id_paciente=$id";
    $res = mysqli_query($conexion, $sql);
    $fila = mysqli_fetch_array($res);
    $nombre= $fila['nombre'];
    $apep= $fila['apep'];
    $apem= $fila['apem'];
    $sexo= $fila['sexo'];
    $domicilio= $fila['domicilio'];
    $fechana= $fila['fechana'];
    $celular= $fila['celular'];

}


if (isset($_POST['actualizacion'])) {
    $id = $_GET['id'];
    $nombre= $_REQUEST['nombre_paciente'];
    $apep= $_REQUEST['apep_paciente'];
    $apem= $_REQUEST['apem_paciente'];
    $sexo= $_REQUEST['sexo_paciente'];
    $domicilio= $_REQUEST['domicilio_paciente'];
    $fechana= $_REQUEST['fechana_paciente'];
    $celular= $_REQUEST['celular_paciente'];


    $sql = "UPDATE paciente set nombre = '$nombre', apep='$apep', apem='$apem', sexo='$sexo',domicilio='$domicilio',fechana='$fechana',celular='$celular' WHERE id_paciente=$id";
    mysqli_query($conexion, $sql) or die ("No se realizó correctamente la actualizacion de los datos");
    header('Location: paciente.php');
}

?>

<?php include('includes/header.php'); ?>
  <div class="container p-4">
    <div class="row">
      <div class="col-md-4 mx-auto">
        <div class="card card-body">
        <form action="actualizarPaciente.php?id=<?php echo $_GET['id']; ?>" method="POST">
          <div class="form-group">
            <input type="text" name="nombre_paciente" class="form-control" value="<?php echo $nombre; ?>" placeholder="Nombre" autofocus required>
          </div>
          <div class="form-group">
            <input type="text" name="apep_paciente" class="form-control" value="<?php echo $apep; ?>" placeholder="Apellido paterno" required>
          </div>
          <div class="form-group">
            <input type="text" name="apem_paciente" class="form-control" value="<?php echo $apem; ?>" placeholder="Apellido materno" required>
          </div>
          <div class="form-group">
            <input type="text" name="domicilio_paciente" class="form-control" value="<?php echo $domicilio; ?>" placeholder="Domicilio" required>
          </div>
          <div class="form-group">
            <input type="date" name="fechana_paciente" class="form-control" value="<?php echo $fechana; ?>" placeholder="Fecha de nacimiento" required>
          </div>
          <div class="form-group">
            <input type="number" name="celular_paciente" class="form-control" value="<?php echo $celular; ?>" placeholder="Celular" maxlength="10" required>
          </div>


          <div class="form-check">
            <input type="radio" class="form-check-input" name="sexo_paciente" class="form-control" required VALUE="M"<?php if($sexo=='M'){?>
              CHECKED>Hombre
           <?php }?>
           <?php if($sexo=='F') {?> 
            >Hombre

           <?php }?>
          </div>
          <div class="form-check">
            <input type="radio" class="form-check-input" name="sexo_paciente" class="form-control" required VALUE="F"<?php if($sexo=='M'){?>
              >Mujer
           <?php }?>
           <?php if($sexo=='F') {?> 
            CHECKED>Mujer

           <?php }?>
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