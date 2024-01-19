<?php
session_start();

$n = $_POST['nom'];
$p = $_POST['pas'];
$p = hash('sha512', $p);

$conexion = mysqli_connect("localhost", "root", "", "activos");
$consulta = "SELECT * FROM itbadmin WHERE user = '$n' and pass = '$p'";
$resultado = mysqli_query($conexion, $consulta);
$filas = mysqli_num_rows($resultado);
if ($filas > 0) {
  $_SESSION['admin'] = $n;

  header("location:/R_MEMORIAS/php/Form_Usuario.php");
  exit;
} else {

  echo
  '<script>
alert("Usuario/Password Incorrectos");
alert("Vuelva a Intentarlo");
window.location = "/R_Memorias/php/Login_Admin.php";
</script>';
}
mysqli_free_result($resultado);
mysqli_close($conexion);
