<?php
include_once '../conexion/conexiones.php';
?>

<?php
session_start();

$fe = $_POST['Fpres'];
$he = $_POST['Hpres'];
$de = $_POST['detalle'];
$pe = $_POST['id_emp'];
$it = $_POST['id_itb'];
$nota = $_POST['nota'];

$insertar = "INSERT INTO prestamo (Fpres,Hpres,detalle,id_empleados,id_itb,nota) VALUES ('$fe','$he','$de','$pe','$it','$nota')";
$resultado = mysqli_query($conexion, $insertar);
if (!$resultado) {
  echo 'Error al Registrar';
} else {
  echo
  '<script>
alert("El Prestamo se registro EXITOSAMENTE");
window.location = "/R_Memorias/php/Form_Prestamo.php";
  </script>';
}
mysqli_close($conexion);
