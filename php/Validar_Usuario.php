<?php
session_start();

$n = $_POST['nom'];
$p = $_POST['pas'];
$p = hash('sha512', $p);

$conexion = mysqli_connect("localhost", "root", "", "activos");
$consulta = "SELECT * FROM usuarios WHERE user = '$n' and pass = '$p'";
$resultado = mysqli_query($conexion, $consulta);
$filas = mysqli_num_rows($resultado);

if ($filas > 0) {
  $_SESSION['usuario'] = $n;

  header("location:/R_MEMORIAS/php/Plantilla.php");
  exit;
} else {

  echo
  '<script>
alert("Usuario/Password Incorrectos");
alert("Vuelva a Intentarlo");
window.location = "/R_Memorias/index.php";
</script>';
}
mysqli_free_result($resultado);
mysqli_close($conexion);
