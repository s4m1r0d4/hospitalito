<?php

session_start();


if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    header("location: hospitalito.php");
    exit;
}

require_once "config.php";

// Procesar los datos si ya se subieron
$usuario = $contra = $error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los parámetros del formulario
    $usuario = $_POST["usuario"];
    $contra  = $_POST["contra"];

    // Buscar al usuario introducido
    $sql  = "SELECT usuario FROM cuenta WHERE usuario = :usuario";
    $stmt = $pdo->prepare($sql);
    if ($stmt == false) die("Error al preparar la consulta del usuario");

    $stmt->bindParam(":usuario", $usuario, PDO::PARAM_STR);
    $usuario = trim(htmlspecialchars($usuario));
    $contra  = trim(htmlspecialchars($contra));

    if ($stmt->execute() == false) die("Error al consultar el usuario");
    if ($stmt->rowCount() != 1) {
        $error = "Usuario no encontrado";
        goto end;
    }

    // Validar al usuario con la contraseña introducida
    $sql = "SELECT * FROM cuenta WHERE usuario = :usuario AND contra = "
        . "AES_ENCRYPT(:contra, UNHEX(SHA2('secretazo', 512)))";
    $stmt = $pdo->prepare($sql);
    if ($stmt == false) die("Error al preparar la consulta de la contraseña");

    $stmt->bindParam(":usuario", $usuario, PDO::PARAM_STR);
    $stmt->bindParam(":contra", $contra, PDO::PARAM_STR);

    if ($stmt->execute() == false) die("Error al consultar la contraseña");
    if ($stmt->rowCount() != 1) {
        $error = "Contraseña incorrecta";
        goto end;
    }

    $row = $stmt->fetch();

    // La contraseña fue correcta, guardar la información de la sesión
    $_SESSION["loggedin"]    = true;
    $_SESSION["id_cuenta"]   = $row["id_cuenta"];
    $_SESSION["usuario"]     = $usuario;
    $_SESSION["privilegios"] = $row["privilegios"];

    echo '<div style="color:#4acb30";>Ingreso exitoso</div>';
    header("location: inicio.php");
    end:
    unset($stmt);
    unset($pdo);
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Inicio de sesión</title>
</head>
<body>
    <center>
    <div class="wrapper">
        <br>
        <h1>Hospitalito</h1>
        <h2>Ingreso</h2>
        <p>Introduzca su usuario y contraseña</p><br><br>

        <?php 
        if(!empty($error)){
            echo '<div class="alert alert-danger" style="color:#FF0000";>'
                . $error. '</div> <br>';
        }        
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
             method="post">
            <div class="form-group">
                <label>Usuario</label><br>
                <input type="text" name="usuario" required="required">
            </div>
            <br><br>
            <div class="form-group">
                <label>Contraseña</label><br>
                <input type="password" name="contra" required="required">
            </div>
            <br><br>
            <div class="form-group">
                <input type="submit" value="Ingresar">
            </div>
        </form>
    </div>
    </center>
</body>
</html>
