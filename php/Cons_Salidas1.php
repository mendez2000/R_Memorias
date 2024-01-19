<?php
include_once "../php/Sesion_Star.php";
include_once '../conexion/conexion3.php';
include_once "../php/plantilla4.php";
include_once "Function_Actualizar.php";
?>

<?php

function db_query_params($enlace, $sql, $params)
{
    $stmt = mysqli_prepare($enlace, $sql);

    if (!$stmt) {
        die("Error en la preparación de la consulta: " . mysqli_error($enlace));
    }

    if (!empty($params)) {
        $types = str_repeat('s', count($params));
        mysqli_stmt_bind_param($stmt, $types, ...$params);
    }

    $result = mysqli_stmt_execute($stmt);

    if (!$result) {
        die("Error en la ejecución de la consulta: " . mysqli_error($enlace));
    }

    $result = mysqli_stmt_get_result($stmt);

    if (!$result) {
        die("Error al obtener el resultado de la consulta: " . mysqli_error($enlace));
    }

    mysqli_stmt_close($stmt);

    return $result;
}

$enlace = mysqli_connect("localhost", "root", "", "activos");

if (!$enlace) {
    die("Error en la conexión: " . mysqli_connect_error());
}

$idCabecera = isset($_GET['idCabecera']) ? $_GET['idCabecera'] : null;

$sql = "SELECT * FROM detalles WHERE id_det = ?";
$params = array($idCabecera);
$result = db_query_params($enlace, $sql, $params);

mysqli_close($enlace);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Cons Detalles</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/R_MEMORIAS/css/stilu.css">
    <link rel="stylesheet" href="/R_MEMORIAS/css/stilos4.css">
    <link rel="stylesheet" href="/R_MEMORIAS/css/menu11.css">
    <link rel="stylesheet" type="text/css" href="/R_MEMORIAS/css/min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>

<body>

    <div class="container">
        <h2>Consulta de Detalles</h2>
        <br>
        <table class="table table-striped" id="tabla">
            <thead>
                <tr>
                    <!--<th width="auto">Id Cabecera</th>-->
                    <th width="auto">Detalles del Equipo</th>
                    <th width="auto">Marca</th>
                    <th width="auto">Serie</th>
                    <th width="auto">Cantidad</th>
                    <th width="auto">Observaciones</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>

                <?php
                while ($row = mysqli_fetch_object($result)) {
                ?>
                    <tr>
                        <!--<td><?php echo $row->id_det; ?></td>-->
                        <td><?php echo $row->detEqui; ?></td>
                        <td><?php echo $row->marca; ?></td>
                        <td><?php echo $row->serie; ?></td>
                        <td><?php echo $row->cant; ?></td>
                        <td><?php echo $row->obs; ?></td>

                        <td><a class="btn btn-success" href="/R_MEMORIAS/php/Editar_Salidas1.php?id=<?php echo $row->id; ?>">Editar</a></td>
                        <td><a class="btn btn-danger" href="/R_MEMORIAS/php/Borrar_Salidas1.php?id=<?php echo $row->id; ?>" onclick="return confirm('Estás seguro que deseas eliminar el registro?');">Eliminar</a></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <td><a class="btn-editar" href="javascript:history.back()">Regresar</a></td>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="//cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#tabla').DataTable();
            });
        </script>
    </div>
</body>

</html>