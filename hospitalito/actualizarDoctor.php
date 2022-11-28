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

if  (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM doctor WHERE id_doctor=$id";
    $res = mysqli_query($conexion, $sql);
    $fila = mysqli_fetch_array($res);
    $nombre= $fila['nombre'];
    $apep= $fila['apep'];
    $apem= $fila['apem'];
    $sexo= $fila['sexo'];
    $domicilio= $fila['domicilio'];
    $fechana= $fila['fechana'];
    $celular= $fila['celular'];
    $especialidad= $fila['id_especialidad'];
}

if (isset($_POST['actualizacion'])) {
    $id = $_GET['id'];
    $nombre= $_REQUEST['nombre_doctor'];
    $apep= $_REQUEST['apep_doctor'];
    $apem= $_REQUEST['apem_doctor'];
    $sexo= $_REQUEST['sexo_doctor'];
    $domicilio= $_REQUEST['domicilio_doctor'];
    $fechana= $_REQUEST['fechana_doctor'];
    $celular= $_REQUEST['celular_doctor'];
    $especialidad= $_REQUEST['especialidad_doctor'];
    $sql = "UPDATE doctor set nombre = '$nombre', apep='$apep', apem='$apem', sexo='$sexo',domicilio='$domicilio',fechana='$fechana',celular='$celular', id_especialidad='$especialidad' WHERE id_doctor=$id";
    mysqli_query($conexion, $sql) or die ("No se realizó correctamente la actualizacion de los datos");
    header('Location: doctor.php');
}
?>
<?php include('includes/header.php'); ?>
  <div class="container p-4">
    <div class="row">
      <div class="col-md-4 mx-auto">
        <div class="card card-body">
        <form action="actualizarDoctor.php?id=<?php echo $_GET['id']; ?>" method="POST">
          <div class="form-group">
            <input type="text" name="nombre_doctor" class="form-control" value="<?php echo $nombre; ?>" placeholder="Nombre" autofocus required>
          </div>
          <div class="form-group">
            <input type="text" name="apep_doctor" class="form-control" value="<?php echo $apep; ?>" placeholder="Apellido paterno" required>
          </div>
          <div class="form-group">
            <input type="text" name="apem_doctor" class="form-control" value="<?php echo $apem; ?>" placeholder="Apellido materno" required>
          </div>
          <div class="form-group">
            <input type="text" name="domicilio_doctor" class="form-control" value="<?php echo $domicilio; ?>" placeholder="Domicilio" required>
          </div>
          <div class="form-group">
            <input type="date" name="fechana_doctor" class="form-control" value="<?php echo $fechana; ?>" placeholder="Fecha de nacimiento" required>
          </div>
          <div class="form-group">
            <input type="number" name="celular_doctor" class="form-control" value="<?php echo $celular; ?>" placeholder="Celular" maxlength="10" required>
          </div>
          <div class="form-group">
            <?php
             $sql = "select * from especialidad where id_especialidad<$especialidad or id_especialidad>$especialidad";
             $tabla = mysqli_query($conexion, $sql);
             //obtener especialidad ingresada anteriormente
             $obtenerNombre="select * from especialidad where id_especialidad=$especialidad";
             $nombreEspecialidad=mysqli_query($conexion,$obtenerNombre);
             $nombreEspecialidad=mysqli_fetch_array($nombreEspecialidad);
             ?>
             <SELECT NAME="especialidad_doctor">
              <OPTION VALUE= <?php echo $especialidad ?> SELECTED><?php echo $nombreEspecialidad['nombre']?>
             <?php  while($mostrar=mysqli_fetch_array($tabla)){   ?>
                <OPTION VALUE= <?php echo $mostrar['id_especialidad'] ?> ><?php echo $mostrar['nombre']?>
             <?php }?>
            </SELECT>

          </div>
          <div class="form-check">
            <input type="radio" class="form-check-input" name="sexo_doctor" class="form-control" required VALUE="M"<?php if($sexo=='M'){?>
              CHECKED>Hombre
           <?php }?>
           <?php if($sexo=='F') {?>
            >Hombre
           <?php }?>
          </div>
          <div class="form-check">
            <input type="radio" class="form-check-input" name="sexo_doctor" class="form-control" required VALUE="F"<?php if($sexo=='M'){?>
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
