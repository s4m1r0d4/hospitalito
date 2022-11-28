<?PHP
$conexion = mysqli_connect("localhost","root","","hospitalito")
    or die ("No se ha podido conectar  al servidor de la base de datos");

$db = mysqli_select_db($conexion, "hospitalito")
    or die("No se ha podido conectar con la base de datos");
?>
