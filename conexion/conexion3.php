<?php
$servidor = "localhost";
$usuario = "root";
$clave = "";
$baseDeDatos = "activos";

$enlace = mysqli_connect($servidor, $usuario, $clave, $baseDeDatos);

if (!$enlace) {
    die("Error en la conexión con el servidor: " . mysqli_connect_error());
}
