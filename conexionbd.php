<?PHP
if (!isset($_SESSION['privilegios'])) {
    $conexion = mysqli_connect("localhost","root","","hospitalito")
        or die ("No se ha podido conectar  al servidor de la base de datos");
    $db = mysqli_select_db($conexion, "hospitalito")
        or die("No se ha podido conectar con la base de datos");
} else {
    $privilegios = $_SESSION['privilegios'];
    if ($privilegios == 1) {
        $conexion = mysqli_connect("localhost","administrador","pur04tl45ch4p4l1t4","hospitalito")
            or die ("No se ha podido conectar  al servidor de la base de datos");
        $db = mysqli_select_db($conexion, "hospitalito")
            or die("No se ha podido conectar con la base de datos");
    } else {
        $conexion = mysqli_connect("localhost","doctor","l4pu3rt4n3gr4","hospitalito")
            or die ("No se ha podido conectar  al servidor de la base de datos");
        $db = mysqli_select_db($conexion, "hospitalito")
            or die("No se ha podido conectar con la base de datos");
    }
}
?>
