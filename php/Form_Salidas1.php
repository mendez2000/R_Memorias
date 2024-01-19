<?php
include_once "../php/Sesion_Star.php";
include_once '../conexion/conexion2.php';
include_once '../php/plantilla3.php';

$id_cabecera = isset($_GET['id']) ? $_GET['id'] : 'valor_por_defecto';
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
      <h4 style="color: #ffffff;">Control de Salida de Equipo/Accesorios</h4>
    </div>

    <form action="/R_MEMORIAS/php/Reg_Salidas1.php" method="POST" onsubmit="return validar();">
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
              <th>Detalles de Equipo</th>
              <th>Marca/Modelo</th>
              <th>Serie/Inventario</th>
              <th>Cantidad</th>
              <th>Observaciones</th>
            </tr>
          </thead>
          <tbody>

            <tr class="detalleFila">
              <input id="id_det" name="id_det" type="hidden" value="<?php echo $id_cabecera; ?>">
              <td><input id="detEqui" name="detEqui" type="text" placeholder="Datos del Equipo" class="input-48" required></td>
              <td><input id="marca" name="marca" type="text" placeholder="Marca"></td>
              <td><input id="serie" name="serie" type="text" placeholder="Serie"></td>
              <td><input id="cant" name="cant" type="number" placeholder="Cant" class="input-48" required></td>
              <td><input id="obs" name="obs" type="text" placeholder="Observaciones"></td>
            </tr>
          </tbody>
        </table>
      </div>

      <div style="text-align: right; margin-top: 10px;">

        <div style="text-align: right; margin-top: 10px;">
          <td><a class="btn-submit" href="javascript:history.back()">Regresar</a></td>
          <input class="btn-submit" type="submit" value="Guardar Registro">
        </div>
      </div>
  </div>
</body>
</form>

</html>