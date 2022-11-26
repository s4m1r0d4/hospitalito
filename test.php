<?php
include "tabla.php";

$pesos = [
    "mil pesos" => "callese"
];

$t = new tabla($pesos);
$t->imprimeTabla();

?>
