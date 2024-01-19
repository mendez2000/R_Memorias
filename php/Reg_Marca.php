<?php
include_once '../conexion/conexiones.php';
?>

<?php
session_start();

$d = $_POST['mar'];

$insertar = "INSERT INTO marca (nom_marca) VALUES ('$d')";
$verificar_marca = mysqli_query($conexion, "SELECT * FROM marca WHERE nom_marca = '$d'");
if (mysqli_num_rows($verificar_marca) > 0) {
  echo
  '<script>
alert("La Marca ya esta registrado");
window.location = "/R_Memorias/php/Form_Marca.php";
  </script>';
  exit;
}
$resultado = mysqli_query($conexion, $insertar);
if (!$resultado) {
  echo 'Error al registrar la Marca ';
} else {
  echo
  '<script>
alert("La Marca se registro EXITOSAMENTE");
window.location = "/R_Memorias/php/Form_Marca.php";
  </script>';
}
mysqli_close($conexion);
