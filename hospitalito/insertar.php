<?PHP
 include "conexionbd.php";

  $tabla=$_REQUEST['tabla'];

  if($tabla=='Registrar Especialidad'){
  	 $nombre= $_REQUEST['nombre_especialidad'];

  	 $id=obtenerid('especialidad');

	$insercion = "INSERT INTO especialidad VALUES($id+1,'$nombre')";

	$resultado = mysqli_query($conexion, $insercion) or die ("No se ha podido realizar la insercion de datos en la base de datos");

   header('Location: especialidad.php');

  }

 
 
 function obtenerid($tabla){
 	global $conexion;
    $obtenerid="select max(id_$tabla) from $tabla";
	$cons=mysqli_query($conexion,$obtenerid) or die ("Error");
	$res=mysqli_fetch_array($cons);
	$id=$res["max(id_$tabla)"];
	return $id;
 }


?>