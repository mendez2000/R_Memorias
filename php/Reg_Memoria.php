<?php
include_once '../conexion/conexiones.php';
?>

<?php
session_start();

$ma = $_POST['mar'];
$mo = $_POST['mod'];
$se = $_POST['ser'];
$ca = $_POST['cap'];
$pe = $_POST['per'];
$es = $_POST['est'];
$it = $_POST['id_itb'];
$fe = $_POST['fec'];
$ob = $_POST['obs'];

$insertar = "INSERT INTO memorias (id_marca,modelo,serie,id_cap,id_empleados,id_estado,id_itb,fecha,obs) VALUES ('$ma','$mo','$se','$ca','$pe','$es','$it','$fe','$ob')";
$resultado = mysqli_query($conexion, $insertar);
if (!$resultado) {
  echo 'Error al Registrar';
} else {
  echo
  '<script>
  alert("La Memoria se registro EXITOSAMENTE");
  window.location = "/R_Memorias/php/Form_Memoria.php";
    </script>';
}

mysqli_close($conexion);
