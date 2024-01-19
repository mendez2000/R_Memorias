<?php
include_once '../conexion/conexiones.php';
?>

<?php
session_start();

$d = $_POST['rol'];

$insertar = "INSERT INTO roles (nom) VALUES ('$d')";
$verificar_marca = mysqli_query($conexion, "SELECT * FROM roles WHERE nom = '$d'");
if (mysqli_num_rows($verificar_marca) > 0) {
  echo
  '<script>
alert("El Rol ya esta registrado");
window.location = "/R_Memorias/php/Form_Roles.php";
  </script>';
  exit;
}
$resultado = mysqli_query($conexion, $insertar);
if (!$resultado) {
  echo 'Error al registrar el Rol ';
} else {
  echo
  '<script>
alert("El Rol se registro EXITOSAMENTE");
window.location = "/R_Memorias/php/Form_Roles.php";
  </script>';
}
mysqli_close($conexion);
