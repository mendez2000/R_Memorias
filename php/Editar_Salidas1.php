<?php
include_once "../php/Sesion_Star.php";
include_once '../conexion/conexion2.php';
include_once '../conexion/conexion3.php';
include_once "../php/plantilla3.php";
include_once "function_Editar.php";
?>

<?php

$id = $_GET['id'];
if (isset($_POST['submit'])) {
  $field = array(

    "detEqui" => $_POST['detEqui'],
    "marca" => $_POST['marca'],
    "serie" => $_POST['serie'],
    "cant" => $_POST['cant'],
    "obs" => $_POST['obs']
  );

  $tbl = "detalles";
  edit($tbl, $field, 'id', $id);
  $id = $_GET['id'];

  $sql = "SELECT * FROM detalles WHERE id = $id";
  $resultMemoria = mysqli_query($enlace, $sql);

  $sqlEntregas = "SELECT * FROM cabecera WHERE id = $id";
  $resultEntregas = mysqli_query($enlace, $sqlEntregas);
  if (!$resultEntregas) {
    die("Error en la consulta de cabecera: " . mysqli_error($enlace));
  }

  if ($resultMemoria) {
    $row = mysqli_fetch_assoc($resultMemoria);
  } else {

    die("Error en la consulta: " . mysqli_error($enlace));
  }

  $result = mysqli_query($enlace, $sql);
  if ($resul) {
    echo '<script>
              alert("El Registro se actualizó correctamente");
              window.history.go(-2);
            </script>';
  } else {
    echo '<script>
              alert("El Registro NO pudo ser actualizado");
              window.history.go(-2);
            </script>';

    die("Error en la consulta: " . mysqli_error($enlace));
  }
}

$sqlMemoria = "SELECT * FROM detalles WHERE id = $id";
$resultMemoria = mysqli_query($enlace, $sqlMemoria);
$row = mysqli_fetch_assoc($resultMemoria);

?>

<br>
<br>
<br>
<br>
<br>
<br>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" type="text/css" href="/R_MEMORIAS/css/Salidas2.css">
  <title>Control de Detalles</title>
</head>
<script>
  function autoResize() {
    const textArea = document.getElementById('autoResize');
    textArea.style.height = 'auto';
    textArea.style.height = textArea.scrollHeight + 'px';
  }

  window.addEventListener('load', autoResize);
</script>

<body>

  <div class="container">
    <div class="form-header">

      <div style="position: relative;">
        <img src="/R_Memorias/img/tvc.png" style="width: 100px; height: auto; position: absolute; top: 0; left: 0;">
        <p style="position: relative; z-index: 1;"></p>
      </div>
      <div style="position: relative;">
        <img src="/R_Memorias/img/eu.png" style="width: 100px; height: auto; position: absolute; top: 0; right: 0;">
        <p style="position: relative; z-index: 1;"></p>
      </div>

      <h4 style="color: #ffffff;">Departamento IT BROADCAST</h4>
      <h4 style="color: #ffffff;">Editar Control de Salida de Equipo/Accesorios</h4>
    </div>

    <form action="" method="post" class="form-grid">
      <div class="wrap-input100 validate-input">

        <table>
          <tbody>
            </tr>
            <tr>
          </tbody>
        </table>
      </div>

      <div id="detallesContainer">
        <table class="detalleTabla">
          <thead>

            <tr class="detalleEncabezado">
              <!--<th>Id Cabecera</th>-->
              <th>Detalle de Equipo</th>
              <th>Marca/Modelo</th>
              <th>Serie/Inventario</th>
              <th>Cantidad</th>
              <th>Observaciones</th>
            </tr>

          </thead>

          <tbody>

            <tr class="detalleFila">
              <!--<td><input type="text" value="<?php echo $row['id_det']; ?>" readonly name="id_det"></td>-->
              <td><input type="text" value="<?php echo $row['detEqui']; ?>" name="detEqui"></td>
              <td><input type="text" value="<?php echo $row['marca']; ?>" name="marca"></td>
              <td><input type="text" value="<?php echo $row['serie']; ?>" name="serie"></td>
              <td><input type="number" value="<?php echo $row['cant']; ?>" name="cant"></td>
              <td><input type="text" value="<?php echo $row['obs']; ?>" name="obs"></td>
            </tr>
          </tbody>
        </table>
      </div>
      <br>
      <div style="grid-column: span 3; text-align: center;">
        <td><a class="btn-submit" href="javascript:history.back()">Regresar</a></td>
        <input class="btn-submit" type="submit" name="submit" value="Actualizar Registro">
      </div>
    </form>
  </div>
</body>

</html>