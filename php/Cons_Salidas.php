<?php
include_once "../php/Sesion_Star.php";
include_once '../conexion/conexion3.php';
include_once "../php/plantilla4.php";
include_once "Function_Actualizar.php";
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Cons Salidas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/R_MEMORIAS/css/stilu.css">
    <link rel="stylesheet" href="/R_MEMORIAS/css/stilos4.css">
    <link rel="stylesheet" href="/R_MEMORIAS/css/menu11.css">
    <link rel="stylesheet" type="text/css" href="/R_MEMORIAS/css/min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>

<body>

    <h2>Consulta pases de Salidas</h2>
    <br>
    <table class="table table-striped" id="tabla">
        <thead>
            <tr>
                <th width="auto">Id</th>
                <th width="auto">Fecha</th>
                <th>Dia del Evento</th>
                <th>Detalles del Evento</th>
                <th>Solicitado Por:</th>
                <th>Departamento</th>
                <th>Resposnable del Equipo</th>
                <th>Observaciones</th>
                <th>Editar</th>
                <th>Eliminar</th>
                <th>Imprimir</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $sql = "SELECT cabecera.id, cabecera.fecha, cabecera.dia,
e1.nom as nombre_jefe,
cabecera.depto, cabecera.detGrab,
e2.nom as nombre_asignado,
detalles.id_det,
detalles.obs
FROM cabecera
INNER JOIN empleados e1 ON e1.id = cabecera.id_jefe
INNER JOIN empleados e2 ON e2.id = cabecera.id_emp
LEFT JOIN detalles ON detalles.id_det = cabecera.id
ORDER BY cabecera.id DESC";

            $result = mysqli_query($enlace, $sql);

            if (!$result) {
                die("Error en la consulta: " . mysqli_error($enlace));
            }

            $previousId = null;
            $showButtons = true;
            while ($row = mysqli_fetch_object($result)) {
                if ($row->id != $previousId) {

            ?>
                    <tr>
                        <td><?php echo $row->id_det; ?></td>
                        <td><?php echo $row->fecha; ?></td>
                        <td><?php echo $row->dia; ?></td>
                        <td><?php echo $row->detGrab; ?></td>
                        <td><?php echo $row->nombre_jefe; ?></td>
                        <td><?php echo $row->depto; ?></td>
                        <td><?php echo $row->nombre_asignado; ?></td>
                        <td><?php echo $row->obs; ?></td>

                        <td><a class="btn btn-success" href="/R_MEMORIAS/php/Editar_Salidas.php?id=<?php echo $row->id; ?>">Editar</a></td>
                        <td><a class="btn btn-danger" href="/R_MEMORIAS/php/Borrar_Salidas.php?id=<?php echo $row->id; ?>" onclick="return confirm('Estás seguro que deseas eliminar el registro?');">Eliminar</a></td>
                        <td><a class="btn btn-primary" href="/R_MEMORIAS/php/Imp_Salidas.php?id=<?php echo $row->id; ?>">Imprimir</a></td>

                    <?php
                    $showButtons = false;
                } else {
                    ?>

                <?php
                }

                $previousId = $row->id;
            }

            if ($showButtons && $previousId !== null) {
                echo '<tr class="separator"><td colspan="16"></td></tr>';
            }
                ?>
    </table>
    <td><a class="btn-editar" href="/R_MEMORIAS/php/Form_Salidas.php">Regresar</a></td>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tabla').DataTable();
        });
    </script>
</body>

</html>