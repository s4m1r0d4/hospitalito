<?php

if (session_status() === PHP_SESSION_NONE) session_start();
session_unset();
require_once "conexionbd.php";

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    header("location: tablas.php");
    exit;
}

// Procesar los datos si ya se subieron
$usuario = $contra = $error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los parámetros del formulario
    $usuario = $_POST["usuario"];
    $contra  = $_POST["contra"];
    $usuario = trim(htmlspecialchars($usuario));
    $contra  = trim(htmlspecialchars($contra));

    // Buscar al usuario introducido
    $sql = "SELECT usuario FROM cuenta WHERE usuario = '$usuario'";
    $res = mysqli_query($conexion, $sql);
    if ($res === false) die("Error al consultar el usuario");

    if ($res->num_rows != 1) {
        $error = "Usuario no encontrado";
        goto end;
    }

    // Validar al usuario con la contraseña introducida
    $sql = "SELECT * FROM cuenta WHERE usuario = '$usuario' AND contra = "
        . "AES_ENCRYPT('$contra', UNHEX(SHA2('secretazo', 512)))";
    $res = mysqli_query($conexion, $sql);
    if ($res === false) die("Error al consultar la contraseña");

    if ($res->num_rows != 1) {
        $error = "Contraseña incorrecta";
        goto end;
    }

    $row = $res->fetch_array(MYSQLI_ASSOC);

    // La contraseña fue correcta, guardar la información de la sesión
    $_SESSION["loggedin"]    = true;
    $_SESSION["id_cuenta"]   = $row["id_cuenta"];
    $_SESSION["usuario"]     = $usuario;
    $_SESSION["privilegios"] = $row["privilegios"];

    header("location: tablas.php");

    end:
    if (!empty($error)) {
        echo $error;
    }
}
?>

<?php include('includes/header.php'); ?>
    <center>
        <div class="wrapper">
            <br>
            <h1>Ingreso</h1>
            <p>Introduzca su usuario y contraseña</p><br><br>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
                 method="post">
                <div class="form-group">
                    <label>Usuario</label><br>
                    <input type="text" name="usuario" required="required">
                </div>
                <br>
                <div class="form-group">
                    <label>Contraseña</label><br>
                    <input type="password" name="contra" required="required">
                </div>
                <br>
                <div class="form-group">
                    <input type="submit" value="Ingresar">
                </div>
                <div>
                <a href="http://localhost/hospitalito/registro.php">Registrar cuenta nueva</a>
                </div>
            </form>
        </div>
    </center>
</html>

<?php include('includes/footer.php'); ?>
