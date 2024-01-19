<?php
include_once "../php/Sesion_Star.php";
include_once '../conexion/conexion2.php';
include_once "../php/plantilla3.php";
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
  <title>Registro Memoria</title>
  <link rel="stylesheet" href="/R_MEMORIAS/css/stilosMe.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

      <h4 style="color: #ffffff;">Departamento ITBROADCAST</h4>
      <h4 style="color: #ffffff;">Registro de Memorias</h4>
    </div>

    <form action="/R_MEMORIAS/php/Reg_Memoria.php" method="POST" onsubmit="return validar();">
      <div class="wrap-input100 validate-input">
        <br>
        <br>

        <table>
          <tbody>
            <tr>
              <td>
                <div class="form-group">
                  <label for="mar">Marca</label>
                  <select class="form-control" id="mar" name="mar" class="select-control" required>
                    <option value="">Seleccionar</option>
                    <?php
                    $con = conexion();
                    $sql = 'SELECT * FROM marca';
                    $query = mysqli_query($con, $sql);
                    while ($row = mysqli_fetch_array($query)) {
                      $idmar = $row['id'];
                      $nommar = $row['nom_marca'];
                    ?>
                      <option value="<?php echo $idmar ?>"><?php echo $nommar ?></option>
                    <?php
                    }
                    ?>
                  </select>
                </div>
              </td>

              <td>
                <div class="form-group">
                  <label for="modelo">Modelo</label>
                  <input class="form-control" id="mod" name="mod" type="text" placeholder="Ingrese el modelo" class="input-48" required>
                </div>
              </td>
              <td>
                <div class="form-group">
                  <label for="serie">Serie</label>
                  <input class="form-control" id="ser" name="ser" type="text" placeholder="Ingrese la serie" class="input-48" required>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <div class="form-group">
                  <label for="cap">Capacidad</label>
                  <select class="form-control" id="cap" name="cap" placeholder="Seleccione Capacidad" class="input-48" required>
                    <option value="">Seleccionar</option>
                    <?php
                    $con = conexion();
                    $sql = 'SELECT * FROM capacidad';
                    $query = mysqli_query($con, $sql);
                    while ($row = mysqli_fetch_array($query)) {
                      $idcap = $row['id'];
                      $nomcap = $row['nom_cap'];
                    ?>
                      <option value="<?php echo $idcap ?>"><?php echo $nomcap ?></option>
                    <?php
                    }
                    ?>
                  </select>
                </div>
              </td>
              <td>
                <div class="form-group">
                  <label for="empleados">Recibido por:</label>
                  <select class="form-control" id="per" name="per" placeholder="Seleccione el colaborador" class="input-48" required onchange="cargarDepartamento()">
                    <option value="">Seleccionar</option>
                    <?php
                    $con = conexion();
                    $sql = 'SELECT e.id, e.nom, d.nom_depto FROM empleados e INNER JOIN depto d ON e.id_depto = d.id';
                    $query = mysqli_query($con, $sql);
                    while ($row = mysqli_fetch_array($query)) {
                      $idcap = $row['id'];
                      $nomcap = $row['nom'];
                      $nomDep = $row['nom_depto'];
                    ?>
                      <option value="<?php echo $idcap ?>" data-depto="<?php echo $nomDep ?>"><?php echo $nomcap ?></option>
                    <?php
                    }
                    ?>
                  </select>
                </div>
              </td>
              <td>
                <div class="form-group">
                  <label for="dep">Departamento:</label>
                  <input class="form-control" id="departamento" type="text" readonly>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <div class="form-group">
                  <label for="est">Estado</label>
                  <select class="form-control" id="est" name="est" placeholder="Seleccione el Estado" class="input-48" required>
                    <option value="">Seleccionar</option>
                    <?php
                    $con = conexion();
                    $sql = 'SELECT * FROM estados';
                    $query = mysqli_query($con, $sql);
                    while ($row = mysqli_fetch_array($query)) {
                      $idest = $row['id'];
                      $nomest = $row['nom_estado'];
                    ?>
                      <option value="<?php echo $idest ?>"><?php echo $nomest ?></option>
                    <?php
                    }
                    ?>
                  </select>
                </div>
              </td>
              <td>
                <div class="form-group">
                  <label for="itb">Entregada por:</label>
                  <select class="form-control" type="text" id="id_itb" name="id_itb" placeholder="Seleccione el colaborador" class="input-48" required>
                    <option value="">Seleccionar</option>
                    < <?php
                      $con = conexion();


                      $sql = 'SELECT e.id, e.nom
                FROM empleados e
                INNER JOIN depto d ON e.id_depto = d.id
                WHERE d.nom_depto = "IT"';

                      $query = mysqli_query($con, $sql);

                      while ($row = mysqli_fetch_array($query)) {
                        $idEmpleado = $row['id'];
                        $nombreEmpleado = $row['nom'];
                      ?> <option value="<?php echo $idEmpleado ?>"><?php echo $nombreEmpleado ?></option>
                    <?php
                      }
                    ?>
                  </select>
                </div>
              </td>
              <td>
                <div class="form-group">
                  <label for="fecha">Fecha:</label>
                  <input class="form-control" id="fec" name="fec" type="date" required>
                </div>
              </td>
            </tr>
            <tr>
              <td colspan="3">
                <div class="form-group">
                  <label for="obs">Observaciones</label>
                  <input class="form-control" id="obs" name="obs" type="text" placeholder="Opcional">
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <br>
      <div style="grid-column: span 3; text-align: center;">
        <input class="btn-submit" type="submit" value="Guardar Registro">
      </div>
    </form>
  </div>

  <script>
    function cargarDepartamento() {
      var empleadoSeleccionado = $("#per").val();
      var departamentoSelect = $("#departamento");
      var depto = $("option:selected", "#per").attr("data-depto");
      departamentoSelect.val(depto);
    }
  </script>
</body>

</html>