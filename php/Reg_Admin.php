<?php
include_once '../conexion/conexiones.php';
?>

<?php
session_start();

$n = $_POST['nom'];
$p = $_POST['pas'];
$p = hash('sha512', $p);

$insertar = "INSERT INTO itbadmin (user,pass) VALUES ('$n','$p')";
$verificar_usuario = mysqli_query($conexion, "SELECT * FROM itbadmin WHERE user = '$n'");
if (mysqli_num_rows($verificar_usuario) > 0) {


  echo '<script>
alert("El Usuario ya esta registrado");
window.location = "/R_Memorias/php/Form_Admin.php";
  </script>';
  exit;
}
$resultado = mysqli_query($conexion, $insertar);
if (!$resultado) {
  echo 'Error al registrar el Usuario';
} else {
  echo '<script>
alert("El Usuario se registro EXITOSAMENTE");
window.location = "/R_Memorias/php/Form_Admin.php";
  </script>';
}
mysqli_close($conexion);
