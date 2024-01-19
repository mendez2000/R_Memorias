<?php
include_once '../conexion/conexiones.php';
?>

<?php
session_start();

$e = $_POST['emp'];
$d = $_POST['dep'];
$r = $_POST['rol'];

$insertar = "INSERT INTO empleados (nom,id_depto,id_rol) VALUES ('$e','$d','$r')";
$verificar_empl = mysqli_query($conexion, "SELECT * FROM empleados WHERE nom = '$e'");
if (mysqli_num_rows($verificar_empl) > 0) {
  echo '<script>
alert("El Nombre ya esta registrado");
window.location = "/R_Memorias/php/Form_Empl.php";
  </script>';
  exit;
}
$resultado = mysqli_query($conexion, $insertar);
if (!$resultado) {
  echo 'Error al registrar el Nombre ';
} else {
  echo '<script>
alert("El Nombre se registro EXITOSAMENTE");
window.location = "/R_Memorias/php/Form_Empl.php";
  </script>';
}
mysqli_close($conexion);
