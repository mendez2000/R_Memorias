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
        "id_marca" => $_POST['mar'],
        "modelo" => $_POST['modelo'],
        "serie" => $_POST['serie'],
        "id_cap" => $_POST['cap'],
        "id_empleados" => $_POST['empleado'],
        "id_estado" => $_POST['est'],
        "id_itb" => $_POST['itb'],
        "fecha" => $_POST['fecha'],
        "obs" => $_POST['obs']
    );

    $tbl = "memorias";
    edit($tbl, $field, 'id', $id);

    $id = $_GET['id'];


    $sql = "SELECT * FROM memorias WHERE id = $id";
    $resultMemoria = mysqli_query($enlace, $sql);

    if ($resultMemoria) {
        $row = mysqli_fetch_assoc($resultMemoria);
    } else {

        die("Error en la consulta: " . mysqli_error($enlace));
    }

    $result = mysqli_query($enlace, $sql);
    if ($result) {
        echo '<script>
            alert("El Registro se actualizó correctamente");
            window.location = "/R_Memorias/php/Cons_Memoria.php";
          </script>';
    } else {
        echo '<script>
        alert("El Registro NO pudo ser actualizado");
        window.location = "/R_Memorias/php/Cons_Memoria.php";
          </script>';

        die("Error en la consulta: " . mysqli_error($enlace));
    }
}

$sqlMemoria = "SELECT * FROM memorias WHERE id = $id";
$resultMemoria = mysqli_query($enlace, $sqlMemoria);
$row = mysqli_fetch_assoc($resultMemoria);


$sqlDeptos = "SELECT id, nom_depto FROM depto";
$resultDeptos = mysqli_query($enlace, $sqlDeptos);
$deptos = mysqli_fetch_all($resultDeptos, MYSQLI_ASSOC);


$sqlMarca = "SELECT id, nom_marca FROM marca";
$resultMarca = mysqli_query($enlace, $sqlMarca);
$marcas = mysqli_fetch_all($resultMarca, MYSQLI_ASSOC);

$sqlEstado = "SELECT id, nom_estado FROM estados";
$resultEstado = mysqli_query($enlace, $sqlEstado);
$estados = mysqli_fetch_all($resultEstado, MYSQLI_ASSOC);

$sqlCap = "SELECT id, nom_cap FROM capacidad";
$resultCap = mysqli_query($enlace, $sqlCap);
$capacidades = mysqli_fetch_all($resultCap, MYSQLI_ASSOC);

$sqlEmpl = "SELECT id, nom FROM empleados";
$resultEmpl = mysqli_query($enlace, $sqlEmpl);
$Empl = mysqli_fetch_all($resultEmpl, MYSQLI_ASSOC);

?>

<br>
<br>
<br>
<br>
<br>
<br>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Editar datos de Memoria</title>
    <link rel="stylesheet" href="/R_MEMORIAS/css/stilos003.css">
    <link rel="stylesheet" href="/R_MEMORIAS/css/stilos04.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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

            <br></br>
            <h3 style="color: black; text-align: center;">Departamento ITBROADCAST</h5>
                <h3 style="color: black; text-align: center;">Editar datos de Memoria</h5>
                    <br></br>
        </div>

        <form action="" method="post" class="form-grid">
            <div class="form-group">

                <label for="mar">Marca</label>
                <select id="mar" name="mar" class="select-control" required>
                    <?php
                    foreach ($marcas as $marca) {
                        $idmar = $marca['id'];
                        $nommar = $marca['nom_marca'];
                        $selected = ($idmar == $row['id_marca']) ? 'selected' : '';
                    ?>
                        <option value="<?php echo $idmar ?>" <?php echo $selected; ?>><?php echo $nommar ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="modelo">Modelo</label>
                <input class="form-control" type="text" value="<?php echo $row['modelo']; ?>" name="modelo">
            </div>
            <div class="form-group">
                <label for="serie">Serie</label>
                <input class="form-control" type="text" value="<?php echo $row['serie']; ?>" name="serie">
            </div>
            <div class="form-group">
                <label for="cap">Capacidad</label>
                <select id="cap" name="cap" class="select-control" required>
                    <?php
                    foreach ($capacidades as $cap) {
                        $idcap = $cap['id'];
                        $nomcap = $cap['nom_cap'];
                        $selected = ($idcap == $row['id_cap']) ? 'selected' : '';
                    ?>
                        <option value="<?php echo $idcap ?>" <?php echo $selected; ?>><?php echo $nomcap ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="emp">Equipo Entregado a:</label>
                <select class="form-control" id="empleado" name="empleado" placeholder="Seleccione el colaborador" required onchange="cargarDepartamento()">

                    <?php
                    $con = conexion();
                    $sql = 'SELECT e.id, e.nom, d.nom_depto FROM empleados e INNER JOIN depto d ON e.id_depto = d.id';
                    $query = mysqli_query($con, $sql);
                    while ($rowEmp = mysqli_fetch_array($query)) {
                        $idcap = $rowEmp['id'];
                        $nomcap = $rowEmp['nom'];
                        $nomDep = $rowEmp['nom_depto'];
                        $selected = ($idcap == $row['id_empleados']) ? 'selected' : '';
                    ?>
                        <option value="<?php echo $idcap ?>" data-depto="<?php echo $nomDep ?>" <?php echo $selected; ?>><?php echo $nomcap ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="dep">Departamento al que se Entrega:</label>
                <input class="form-control" type="text" id="departamento" readonly value="<?php echo $nomDep; ?>">
            </div>
            <div class="form-group">
                <label for="est">Estado</label>
                <select id="est" name="est" class="select-control" required>
                    <?php
                    foreach ($estados as $estado) {
                        $idest = $estado['id'];
                        $nomest = $estado['nom_estado'];
                        $selected = ($idest == $row['id_estado']) ? 'selected' : '';
                    ?>
                        <option value="<?php echo $idest ?>" <?php echo $selected; ?>><?php echo $nomest ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <label for="itb">Atendido por:</label>
                <select class="form-control" id="itb" name="itb" required>
                    <option value="">Seleccionar</option>
                    <?php
                    $sql = 'SELECT * FROM empleados WHERE id_depto = 11';
                    $query = mysqli_query($con, $sql);
                    while ($row2 = mysqli_fetch_array($query)) {
                        $iditb = $row2['id'];
                        $nomitb = $row2['nom'];
                        $selected = ($iditb == $row['id_itb']) ? 'selected' : '';
                        echo '<option value="' . $iditb . '" ' . $selected . '>' . $nomitb . '</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="fecha">Fecha:</label>
                <input class="form-control" type="date" value="<?php echo $row['fecha']; ?>" name="fecha">
            </div>
            <div class="form-group" style="grid-column: span 2;">
                <label for="obs">Observaciones</label>
                <input class="form-control" type="text" value="<?php echo $row['obs']; ?>" name="obs">
            </div>
            <div class="form-group" style="grid-column: span 2; text-align: center;">
                <input class="btn-submit" type="submit" name="submit" value="Actualizar Registro">
            </div>
        </form>
    </div>
    <script>
        function cargarDepartamento() {
            var empleadoSeleccionado = $("#empleado").val();
            var departamentoSelect = $("#departamento");
            var depto = $("option:selected", "#empleado").attr("data-depto");
            departamentoSelect.val(depto);
        }
        cargarDepartamento();
    </script>

</body>

</html>