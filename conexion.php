<?php

mysqli_report(MYSQLI_REPORT_OFF);

$conexion = new mysqli("localhost","root","123","crudalumnosphp",3306);

if($conexion->connect_error) {
    die("No se logro la conexion".$conexion->connect_error);
}

?>
