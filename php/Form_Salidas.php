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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" type="text/css" href="/R_MEMORIAS/css/Salidas2.css">
  <title>Control de Salidas</title>
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

    <form action="/R_MEMORIAS/php/Reg_Salidas.php" method="POST" onsubmit="return validar();">
      <div class="wrap-input100 validate-input">
        <table>
          <tbody>
            <tr>
              <td>
                <div class="form-group">
                  <label for="fecha">Fecha:</label>
                  <input type="date" name="fe" id="fechaInput" onchange="actualizarDia()" required>
                </div>
              </td>
              <td>
                <div class="form-group">
                  <label for="dia">Dia:</label>
                  <input type="text" name="di" id="diaInput" placeholder="Dia del Evento" required readonly>
                </div>
              </td>
            </tr>
            <tr>
              <td>

                <div class="form-group">
                  <label for="jefe">Solicitado Por:</label>
                  <select type="text" id="jefe" name="jef" placeholder="Seleccione Jefe Autorizado" class="input-48" required onchange="cargarDepartamento()">
                    <option value="">Seleccionar</option>
                    <?php
                    $con = conexion();

                    $sql = 'SELECT e.id, e.nom, e.id_depto, d.nom_depto
                FROM empleados e
                INNER JOIN roles r ON e.id_rol = r.id
                INNER JOIN depto d ON e.id_depto = d.id
                WHERE r.nom = "Jeje"';

                    $query = mysqli_query($con, $sql);

                    while ($row = mysqli_fetch_array($query)) {
                      $idEmpleado = $row['id'];
                      $nombreEmpleado = $row['nom'];
                      $idDepto = $row['id_depto'];
                      $nomDepto = $row['nom_depto'];
                    ?>
                      <option value="<?php echo $idEmpleado ?>" data-depto="<?php echo $nomDepto ?>"><?php echo $nombreEmpleado ?></option>
                    <?php
                    }
                    ?>
                  </select>
                </div>
              </td>
              <td>
                <div class="form-group">
                  <label for="depto">Departamento:</label>
                  <input id="depto" name="dep" type="text" readonly>
                </div>
              </td>
              <td>
                <div class="form-group">
                  <label for="empl">Personal Asignado:</label>
                  <select type="text" id="id_emp" name="em" placeholder="Responsable del Equipo" class="input-48" required>
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
            </tr>

            <td colspan="3">
              <div class="form-group">
                <label for="detGrab">Detalle de la Grabacion</label>
                <input type="text" name="det" placeholder="Descripción del Evento" required>
              </div>
            </td>
            </tr>
            <tr>
          </tbody>
        </table>
      </div>

      <div id="detallesContainer">
        <table class="detalleTabla">
          <thead>
            <tr class="detalleEncabezado">
              <th>#</th>
              <th>Detalle de Equipo*</th>
              <th>Marca/Modelo</th>
              <th>Serie/Inventario</th>
              <th>Cantidad</th>
              <th>Observaciones</th>
              <th>Acción</th>
            </tr>
          </thead>
          <tbody>
            <tr class="detalleFila">
              <td class="numeroFila">1</td>
              <td><input type="text" name="detEqui[]" placeholder="Datos del Equipo" required></td>
              <td><input type="text" name="marca[]" placeholder="Opcional"></td>
              <td><input type="text" name="serie[]" placeholder="Opcional"></td>
              <td><input type="number" name="cant[]" placeholder="Cantidad" required></td>
              <td><input type="text" name="obs[]" placeholder="Opcional"></td>
              <td><button class="btn-submit" type="button" onclick="eliminarDetalle(this)">Eliminar</button></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div style="text-align: right; margin-top: 10px;">
        <td>
          <input class="btn-submit" type="submit" value="Guardar Registro">
          <button class="btn-submit" type="button" onclick="agregarDetalle()">Agregar Fila</button>

      </div>

  </div>
  <script>
    var detalleIndex = 2;

    function agregarDetalle() {
      var detallesContainer = document.getElementById('detallesContainer');
      var filasActuales = detallesContainer.querySelectorAll('.detalleFila');

      if (filasActuales.length < 12) {
        var nuevaFila = document.querySelector('.detalleFila').cloneNode(true);
        nuevaFila.id = 'detalleFila' + detalleIndex;
        nuevaFila.style.display = 'flex';

        var numeroFila = nuevaFila.querySelector('.numeroFila');
        numeroFila.textContent = detalleIndex;
        numeroFila.style.color = 'white';

        var campos = ['detEqui', 'marca', 'serie', 'cant', 'obs'];
        campos.forEach(function(campo) {
          var input = nuevaFila.querySelector('[name="' + campo + '[]"]');
          input.value = '';
        });

        detallesContainer.appendChild(nuevaFila);
        detalleIndex++;

        var primeraFila = detallesContainer.querySelector('.detalleFila');
        var numeroPrimeraFila = primeraFila.querySelector('.numeroFila');
        numeroPrimeraFila.style.color = 'white';
      } else {
        alert('No se pueden agregar más de 12 filas.');
      }
    }

    function eliminarDetalle(btn) {
      var detallesContainer = document.getElementById('detallesContainer');
      var fila = btn.parentNode.parentNode;
      detallesContainer.removeChild(fila);
      var filasRestantes = detallesContainer.querySelectorAll('.detalleFila');
      filasRestantes.forEach(function(fila, index) {
        fila.querySelector('.numeroFila').textContent = index + 1;
      });

      detalleIndex--;
    }

    function cargarDepartamento() {
      var empleadoSeleccionado = $("#jefe").val();
      var departamentoSelect = $("#depto");
      var depto = $("option:selected", "#jefe").attr("data-depto");
      departamentoSelect.val(depto);
    }
  </script>

  <script>
    function actualizarDia() {
      var fechaSeleccionada = document.getElementById('fechaInput').value;
      var fecha = new Date(fechaSeleccionada + 'T00:00:00');
      var diaSemana = fecha.getUTCDay();
      var diasSemana = ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"];
      document.getElementById('diaInput').value = diasSemana[diaSemana];
    }
  </script>
</body>
</form>

</html>