<?php
include_once '../conexion/conexiones.php';
?>

<?php
session_start();

$d = $_POST['depto'];

$insertar = "INSERT INTO depto (nom_depto) VALUES ('$d')";
$verificar_depto = mysqli_query($conexion, "SELECT * FROM depto WHERE nom_depto = '$d'");
if (mysqli_num_rows($verificar_depto) > 0) {
  echo '<script>
alert("El Departamento ya esta registrado");
window.location = "/R_Memorias/php/Form_Depto.php";
  </script>';
  exit;
}
$resultado = mysqli_query($conexion, $insertar);
if (!$resultado) {
  echo 'Error al registrar el Departamento ';
} else {
  echo '<script>
alert("El Departamento se registro EXITOSAMENTE");
window.location = "/R_Memorias/php/Form_Depto.php";
  </script>';
}
mysqli_close($conexion);
