<?php
    if (session_status() === PHP_SESSION_NONE) session_start();
    if (!isset($_SESSION['loggedin']) or $_SESSION['loggedin'] != true
        or isset($_GET["cerrar_sesion"])) {
        $_SESSION['loggedin'] = false;
        header("location: inicio.php");
        exit;
    }
?>
<?PHP
include "conexionbd.php";
$tabla = $_REQUEST['tabla'];
if($tabla=='Registrar Especialidad'){
    $nombre= $_REQUEST['nombre_especialidad'];
    $id=obtenerid('especialidad');
    $insercion = "INSERT INTO especialidad VALUES($id+1,'$nombre')";
    $resultado = mysqli_query($conexion, $insercion) or die ("No se ha podido realizar la insercion de datos en la base de datos");
}
if($tabla=='Registrar Medicamento'){
    $nombre= $_REQUEST['nombre_medicamento'];
    $id=obtenerid('medicamento');
    $insercion = "INSERT INTO medicamento VALUES($id+1,'$nombre')";
    $resultado = mysqli_query($conexion, $insercion) or die ("No se ha podido realizar la insercion de datos en la base de datos");
}
if($tabla=='Registrar Sala'){
    $nombre= $_REQUEST['nombre_sala'];
    $id=obtenerid('sala');
    $insercion = "INSERT INTO sala VALUES($id+1,'$nombre')";
    $resultado = mysqli_query($conexion, $insercion) or die ("No se ha podido realizar la insercion de datos en la base de datos");
}
if($tabla=='Registrar Paciente'){
    $nombre= $_REQUEST['nombre_paciente'];
    $apep= $_REQUEST['apep_paciente'];
    $apem= $_REQUEST['apem_paciente'];
    $sexo= $_REQUEST['sexo_paciente'];
    $domicilio= $_REQUEST['domicilio_paciente'];
    $fechana= $_REQUEST['fechana_paciente'];
    $celular= $_REQUEST['celular_paciente'];

    $id=obtenerid('paciente');
    $insercion = "INSERT INTO paciente VALUES($id+1, '$fechana','$celular','$domicilio','$sexo','$nombre','$apep','$apem')";
    $resultado = mysqli_query($conexion, $insercion) or die ("No se ha podido realizar la insercion de datos en la base de datos");
}
if($tabla=='Registrar Doctor'){
    $nombre= $_REQUEST['nombre_doctor'];
    $apep= $_REQUEST['apep_doctor'];
    $apem= $_REQUEST['apem_doctor'];
    $sexo= $_REQUEST['sexo_doctor'];
    $domicilio= $_REQUEST['domicilio_doctor'];
    $fechana= $_REQUEST['fechana_doctor'];
    $celular= $_REQUEST['celular_doctor'];
    $especialidad=$_REQUEST['especialidad_doctor'];

    $id=obtenerid('doctor');
    $insercion = "INSERT INTO doctor VALUES($id+1, '$especialidad', '$nombre','$apep','$apem','$sexo','$domicilio','$fechana','$celular')";
    $resultado = mysqli_query($conexion, $insercion) or die ("No se ha podido realizar la insercion de datos en la base de datos");
}
if($tabla=='Registrar Receta'){
    $paciente= $_REQUEST['paciente_receta'];
    $medicamento= $_REQUEST['medicamento_receta'];
    $fechaini= $_REQUEST['fechaini_receta'];
    $fechafin= $_REQUEST['fechafin_receta'];
    $dosis= $_REQUEST['dosis'];

    $id=obtenerid('receta');
    $insercion = "INSERT INTO receta VALUES($id+1, '$paciente', '$medicamento','$dosis','$fechaini','$fechafin')";
    $resultado = mysqli_query($conexion, $insercion) or die ("No se ha podido realizar la insercion de datos en la base de datos");
}
if($tabla=='Registrar Cirugia'){
    $paciente= $_REQUEST['paciente_cirugia'];
    $doctor= $_REQUEST['doctor_cirugia'];
    $fechaini= $_REQUEST['fechaini_cirugia'];
    $sala= $_REQUEST['sala_cirugia'];

    $id=obtenerid('cirugia');
    $insercion = "INSERT INTO cirugia VALUES($id+1, '$paciente', '$sala','$doctor','$fechaini')";
    $resultado = mysqli_query($conexion, $insercion) or die ("No se ha podido realizar la insercion de datos en la base de datos");
}

$table = substr($tabla,+10);
header("Location: $table.php");

function obtenerid($tabla) {
    global $conexion;
    $obtenerid="select max(id_$tabla) from $tabla";
    $cons=mysqli_query($conexion,$obtenerid) or die ("Error");
    $res=mysqli_fetch_array($cons);
    $id=$res["max(id_$tabla)"];
    return $id;
}
?>
