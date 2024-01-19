<?php
include_once "../php/Sesion_Star.php";
include_once '../conexion/conexion2.php';
include_once '../conexion/conexion3.php';
include_once "../php/plantilla3.php";
include_once "function_Editar.php";
?>

<?php

$id = isset($_GET['id']) ? $_GET['id'] : null;

if (isset($_POST['submit'])) {
    $field = array(
        "detGrab" => $_POST['detGrab'],
        "id_jefe" => $_POST['id_jefe'],
        "depto" => $_POST['depto'],
        "fecha" => $_POST['fecha'],
        'dia' => $_POST['dia'],
        'id_emp' => $_POST['id_emp']

    );
    $tbl = "cabecera";
    edit($tbl, $field, 'id', $id);
    $detalles = $_POST['detalles'];

    foreach ($detalles as $index => $detalle) {
        $detalleField = array(
            "detEqui" => $detalle['detEqui'],
            "marca" => $detalle['marca'],
            "serie" => $detalle['serie'],
            "cant" => $detalle['cant'],
            "obs" => $detalle['obs']
        );

        $tblDetalles = "detalles";
        edit($tblDetalles, $detalleField, 'id_det', $index);
    }
    if ($result) {
        echo '<script>
                alert("El Registro se actualizó correctamente");
                window.location.href = window.location.href;
              </script>';
    } else {
        echo '<script>
                alert("El Registro NO pudo ser actualizado");
                window.location.href = window.location.href;
              </script>';

        die("Error en la consulta: " . mysqli_error($enlace));
    }
}

$sqlEntregas = "SELECT * FROM cabecera WHERE id = $id";
$resultEntregas = mysqli_query($enlace, $sqlEntregas);
if (!$resultEntregas) {
    die("Error en la consulta de cabecera: " . mysqli_error($enlace));
}

$rowEntregas = mysqli_fetch_assoc($resultEntregas);

$sqlDetalles = "SELECT * FROM detalles WHERE id_det = $id";
$resultDetalles = mysqli_query($enlace, $sqlDetalles);
if (!$resultDetalles) {
    die("Error en la consulta de detalles: " . mysqli_error($enlace));
}

$detalles = mysqli_fetch_all($resultDetalles, MYSQLI_ASSOC);

$sqlDeptos = "SELECT id, nom_depto FROM depto";
$resultDeptos = mysqli_query($enlace, $sqlDeptos);
$deptos = mysqli_fetch_all($resultDeptos, MYSQLI_ASSOC);

$sqlEmplJefe = "SELECT e.id, e.nom, d.nom_depto
                FROM empleados e
                INNER JOIN roles r ON e.id_rol = r.id
                INNER JOIN depto d ON e.id_depto = d.id
                WHERE r.nom = 'Jeje'";
$resultEmplJefe = mysqli_query($enlace, $sqlEmplJefe);
$emplJefe = mysqli_fetch_all($resultEmplJefe, MYSQLI_ASSOC);

$sqlEmpl = "SELECT id, nom, id_depto FROM empleados";
$resultEmpl = mysqli_query($enlace, $sqlEmpl);
$empl = mysqli_fetch_all($resultEmpl, MYSQLI_ASSOC);
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
    <title>Editar de Salidas</title>
    <link rel="stylesheet" type="text/css" href="/R_MEMORIAS/css/salidas20.css">
    <link rel="stylesheet" type="text/css" href="/R_MEMORIAS/css/min.css">
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

            <h4 style="color: #ffffff;">Departamento IT BROADCAST</h4>
            <h4 style="color: #ffffff;">Editar Control de Salida de Equipo/Accesorios</h4>
        </div>

        <form action="" method="post" class="form-grid">
            <table>
                <tbody>
                    <tr>
                        <td>
                            <div class="form-group">
                                <label for="fecha">Fecha:</label>
                                <input type="date" name="fecha" id="fechaInput" onchange="actualizarDia()" value="<?php echo $rowEntregas['fecha']; ?>">
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <label for="dia">Dia:</label>
                                <input type="text" name="dia" id="diaInput" onchange="actualizarDia()" value="<?php echo $rowEntregas['dia']; ?>">
                            </div>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group">
                                <label for="jefe">Solicitado Por:</label>
                                <select type="text" id="jefe" name="id_jefe" placeholder="Seleccione Jefe Autorizado" class="input-48" required onchange="cargarDepartamento()">
                                    <option value="">Seleccionar</option>
                                    <?php
                                    foreach ($emplJefe as $rowJefe) {
                                    ?>
                                        <option value="<?php echo $rowJefe['id'] ?>" data-depto="<?php echo $rowJefe['nom_depto'] ?>" <?php if ($rowEntregas['id_jefe'] == $rowJefe['id']) echo 'selected="selected"'; ?>>
                                            <?php echo $rowJefe['nom'] ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <label for="depto">Departamento:</label>
                                <input id="depto" name="depto" type="text" readonly value="<?php echo $rowEntregas['depto']; ?>">
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <label for="empl">Personal Asignado:</label>
                                <select type="text" id="id_emp" name="id_emp" placeholder="Responsable del Equipo" class="input-48" required>
                                    <option value="">Seleccionar</option>
                                    <?php
                                    foreach ($empl as $rowEmp) {
                                    ?>
                                        <option value="<?php echo $rowEmp['id'] ?>" data-depto="<?php echo $rowEmp['id_depto'] ?>" <?php if ($rowEntregas['id_emp'] == $rowEmp['id']) echo 'selected="selected"'; ?>>
                                            <?php echo $rowEmp['nom'] ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <div class="form-group">
                                <label for="detGrab">Detalle de la Grabacion</label>
                                <input type="text" name="detGrab" value="<?php echo $rowEntregas['detGrab']; ?>">
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="form-header">
                <h3 style="color: #ffffff;">Detalles Equipos/Accesorios</h3>
            </div>

            <thead>

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
                            <?php foreach ($detalles as $index => $detalle) : ?>
                                <tr class="detalleFila">
                                    <!--<td><input type="text" name="detalles[<?php echo $index; ?>][id_det]" value="<?php echo $detalle['id_det']; ?>" readonly></td>-->
                                    <td><input type="text" name="detalles[<?php echo $index; ?>][detEqui]" value="<?php echo $detalle['detEqui']; ?>" readonly></td>
                                    <td><input type="text" name="detalles[<?php echo $index; ?>][marca]" value="<?php echo $detalle['marca']; ?>" readonly></td>
                                    <td><input type="text" name="detalles[<?php echo $index; ?>][serie]" value="<?php echo $detalle['serie']; ?>" readonly></td>
                                    <td><input type="number" name="detalles[<?php echo $index; ?>][cant]" value="<?php echo $detalle['cant']; ?>" readonly></td>
                                    <td><input type="text" name="detalles[<?php echo $index; ?>][obs]" value="<?php echo $detalle['obs']; ?>" readonly></td>
                                </tr>

                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div style="grid-column: span 3; text-align: center;">
                    <td><a class="btn-submit" href="/R_MEMORIAS/php/Imp_Salidas.php?id=<?php echo $id; ?>">Imprimir</a></td>
                    <td><input class="btn-submit" type="submit" name="submit" value="Actualizar Registro"></td>
                    <td><a class="btn btn-submit btn-custom" href="/R_MEMORIAS/php/Cons_Salidas1.php?idCabecera=<?php echo $id; ?>">Editar Filas</a></td>
                    <td><a class="btn btn-submit btn-custom" href="/R_MEMORIAS/php/Form_Salidas1.php?id=<?php echo $id; ?>">Nueva Fila</a></td>
                </div>
        </form>
    </div>

    <script>
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

</html>