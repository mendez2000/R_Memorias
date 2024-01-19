<?php
include_once '../conexion/conexiones.php';
?>

<?php
session_start();

$d = $_POST['esta'];

$insertar = "INSERT INTO estados (nom_estado) VALUES ('$d')";
$verificar_marca = mysqli_query($conexion, "SELECT * FROM estados WHERE nom_estado = '$d'");
if (mysqli_num_rows($verificar_marca) > 0) {
  echo '<script>
alert("El Estado ya esta registrado");
window.location = "/R_Memorias/php/Form_Estado.php";
  </script>';
  exit;
}
$resultado = mysqli_query($conexion, $insertar);
if (!$resultado) {
  echo 'Error al registrar el Estado ';
} else {
  echo '<script>
alert("El Estado se registro correctamente");
window.location = "/R_Memorias/php/Form_Estado.php";
  </script>';
}
mysqli_close($conexion);
