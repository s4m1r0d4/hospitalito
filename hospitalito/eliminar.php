<?php

include("conexionbd.php");

if(isset($_GET['tabla'])){
  $tabla=$_GET['tabla'];
}

if(isset($_GET['id'])) {
  if($tabla=='especialidad'){
    $id = $_GET['id'];
    $sql = "DELETE FROM especialidad WHERE id_especialidad = $id";
    $result = mysqli_query($conexion, $sql) or die("Error en el eliminado de datos");

    header('Location: especialidad.php');
  }
}

?>