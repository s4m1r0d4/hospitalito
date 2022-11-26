<?php

include "config.php";
include "tabla.php";

$name = "medicamento";
$sql = $pdo->prepare("SELECT * FROM {$name}");
$sql->execute();
$t = new tabla($name, $sql);
$t->imprimeTabla();

?>
