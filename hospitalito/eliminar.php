<?php

include("conexionbd.php");


if(isset($_GET['id']) && isset($_GET['tabla'])){
    $tabla=$_GET['tabla'];
    $id = $_GET['id'];
    $sql = "DELETE FROM $tabla WHERE id_$tabla = $id";
    echo $sql;
    $result = mysqli_query($conexion, $sql) or die("Error en el eliminado de datos");

    header("Location: $tabla.php");
}
