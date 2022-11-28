<?php
if (session_status() === PHP_SESSION_NONE) session_start();

require_once "conexionbd.php";

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    header("location: tablas.php");
    exit;
}

// Procesar los datos si ya se subieron
$usuario = $contra = $contra_conf = $error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los parámetros del formulario
    $usuario      = $_POST["usuario"];
    $contra       = $_POST["contra"];
    $contra_conf  = $_POST["contra_conf"];
    $usuario      = trim(htmlspecialchars($usuario));
    $contra       = trim(htmlspecialchars($contra));
    $contra_conf  = trim(htmlspecialchars($contra_conf));

    // Buscar al usuario introducido
    $sql = "SELECT usuario FROM cuenta WHERE usuario = '$usuario'";
    $res = mysqli_query($conexion, $sql);
    if ($res === false) die("Error al consultar el usuario");

    if ($res->num_rows == 1) {
        $error = "El usuario ya existe";
        goto end;
    }

    // Verificar si la contraseña se confirmó correctamente
    if ($contra != $contra_conf) {
        $error = "Las contraseñas no coinciden";
        goto end;
    }

    // Insertar el registro
    $sql = "INSERT INTO cuenta (usuario, contra, privilegios)";
    $sql .= " VALUE ('$usuario', AES_ENCRYPT('$contra', UNHEX(SHA2('secretazo', 512))), 0)";
    $res = mysqli_query($conexion, $sql);
    if ($res === false) die("Error al crear la cuenta");

    // Encontrar el id asignado
    $sql = "SELECT id_cuenta, usuario, privilegios FROM cuenta WHERE usuario = '$usuario'";
    $res = mysqli_query($conexion, $sql);
    $row = $res->fetch_array(MYSQLI_ASSOC);

    // La contraseña fue correcta, guardar la información de la sesión
    $_SESSION["loggedin"]    = true;
    $_SESSION["id_cuenta"]   = $row["id_cuenta"];
    $_SESSION["usuario"]     = $usuario;
    $_SESSION["privilegios"] = $row["privilegios"];

    echo 'Ingreso exitoso<br>';
    echo '<a href="http://localhost/hospitalito/tablas.php">Ingresar al sistema</a>';

    end:
    if(!empty($error)){
        echo $error;
    }
}
?>


<?php include('includes/header.php'); ?>

    <center>
        <div class="wrapper">
            <br>
            <h1>Registro</h1>
            <p>Cree una cuenta nueva</p><br><br>

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
                <div class="form-group">
                    <label>Confirmar contraseña</label><br>
                    <input type="password" name="contra_conf" required="required">
                </div>
                <br>
                <div class="form-group">
                    <input type="submit" value="Registrar">
                </div>
                <div>
                <a href="http://localhost/hospitalito/inicio.php">Ingresar con una cuenta existente</a>
                </div>
            </form>
        </div>
    </center>
</html>

<?php include('includes/footer.php'); ?>
