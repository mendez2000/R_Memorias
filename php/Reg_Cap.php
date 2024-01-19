<?php
include_once '../conexion/conexiones.php';
?>

<?php
session_start();

$d = $_POST['cap'];

$insertar = "INSERT INTO capacidad (nom_cap) VALUES ('$d')";
$verificar_marca = mysqli_query($conexion, "SELECT * FROM capacidad WHERE nom_cap = '$d'");
if (mysqli_num_rows($verificar_marca) > 0) {
  echo '<script>
  alert("El Valor ya esta registrado");
  window.location = "/R_Memorias/php/Form_Cap.php";
    </script>';
  exit;
}
$resultado = mysqli_query($conexion, $insertar);
if (!$resultado) {
  echo 'Error al registrar el Valor ';
} else {
  echo '<script>
  alert("El Valor se registro EXITOSAMENTE");
  window.location = "/R_Memorias/php/Form_Cap.php";
    </script>';
}
mysqli_close($conexion);
