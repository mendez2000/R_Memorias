<?php
include_once "../php/Sesion_Star.php";
include_once '../conexion/conexion3.php';
include_once "../php/plantilla4.php";
include_once "Function_Actualizar.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Entregas</title>
    <link rel="stylesheet" href="/R_MEMORIAS/css/stilu.css">
    <link rel="stylesheet" href="/R_MEMORIAS/css/stilos4.css">
    <link rel="stylesheet" href="/R_MEMORIAS/css/menu11.css">
    <link rel="stylesheet" type="text/css" href="/R_MEMORIAS/css/min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>

<body>
    <h2>Consulta Equipos/Accesorios Entregados</h2>
    <br>
    <table class="table table-striped" id="tabla">
        <thead>
            <tr id='titulo'>

                <th width="auto">Fecha/Entrega</th>
                <th>Hora/Entrega</th>
                <th>Descripción del Equipo</th>
                <th>Solicitado por:</th>
                <th>Departamento</th>
                <th>Entregada por:</th>
                <th>Observaciones</th>
                <th>Editar</th>
                <th>Eliminar</th>
                <th>Imprimir</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT entregas.id,
entregas.Fpres,
entregas.Hpres,
entregas.detalle,
e1.nom AS solicitante,
e2.nom AS entregador,
(SELECT depto.nom_depto FROM depto WHERE depto.id = e1.id_depto) AS nom_depto_solicitante,
(SELECT depto.nom_depto FROM depto WHERE depto.id = e2.id_depto) AS nom_depto_entregador,
e1.nom AS nombre_solicitante,
e2.nom AS nombre_entregador,
entregas.nota
FROM entregas
INNER JOIN empleados AS e1 ON entregas.id_emp = e1.id
INNER JOIN empleados AS e2 ON entregas.id_itb = e2.id
ORDER BY entregas.id
LIMIT 150";

            $result = mysqli_query($enlace, $sql);
            if (!$result) {
                die("Error en la consulta: " . mysqli_error($enlace));
            }
            while ($row = mysqli_fetch_object($result)) {
            ?>
                <tr>
                    <td><?php echo $row->Fpres; ?></td>
                    <td><?php echo $row->Hpres; ?></td>
                    <td><?php echo $row->detalle; ?></td>
                    <td><?php echo $row->solicitante; ?></td>
                    <td><?php echo $row->nom_depto_solicitante; ?></td>
                    <td><?php echo $row->nombre_entregador; ?></td>
                    <td><?php echo $row->nota; ?></td>

                    <td><a class="btn btn-success" href="/R_MEMORIAS/php/Editar_Entrega.php?id=<?php echo $row->id; ?>">Editar</a></td>
                    <td><a class="btn btn-danger" href="/R_MEMORIAS/php/Borrar_Entrega.php?id=<?php echo $row->id; ?>" onclick="return confirm('Estás seguro que deseas eliminar el registro?');">Eliminar</a></td>
                    <td><a class="btn btn-primary" href="/R_MEMORIAS/php/Imp_Entrega.php?id=<?php echo $row->id; ?>">Imprimir</a></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <td><a class="btn-editar" href="/R_MEMORIAS/php/Form_Entrega.php">Regresar</a></td>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tabla').DataTable();
        });
    </script>
</body>

</html>