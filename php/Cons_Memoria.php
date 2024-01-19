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
    <title>Consulta Memorias</title>
    <link rel="stylesheet" href="/R_MEMORIAS/css/stilu.css">
    <link rel="stylesheet" href="/R_MEMORIAS/css/stilos4.css">
    <link rel="stylesheet" href="/R_MEMORIAS/css/menu11.css">
    <link rel="stylesheet" type="text/css" href="/R_MEMORIAS/css/min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>

<body>

    <h2>Consulta Memorias Entregadas</h2>
    <br>
    <table class="table table-striped" id="tabla">
        <thead>
            <tr>
                <th width="auto">Marca</th>
                <th>Modelo</th>
                <th>Serie</th>
                <th>Capacidad</th>
                <th>Solicitada por:</th>
                <th>Departamento</th>
                <th>Estado</th>
                <th>Entregada por:</th>
                <th>Fecha</th>
                <th>Observaciones</th>
                <th>Editar</th>
                <th>Eliminar</th>
                <th>Imprimir</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT
memorias.id,
marca.nom_marca,
memorias.modelo,
memorias.serie,
capacidad.nom_cap AS nom_cap,
e1.nom AS solicitante,
(SELECT depto.nom_depto FROM depto WHERE depto.id = e1.id_depto) AS nom_depto_solicitante,
e1.nom AS nombre_solicitante,
depto.nom_depto AS nom_depto,
estados.nom_estado AS nom_estado,
e2.nom AS entregador,
(SELECT depto.nom_depto FROM depto WHERE depto.id = e2.id_depto) AS nom_depto_entregador,
e2.nom AS nombre_entregador,
memorias.fecha,
memorias.obs
FROM memorias
INNER JOIN marca ON memorias.id_marca = marca.id
INNER JOIN estados ON memorias.id_estado = estados.id
INNER JOIN capacidad ON memorias.id_cap = capacidad.id
INNER JOIN empleados AS e1 ON memorias.id_empleados = e1.id
INNER JOIN empleados AS e2 ON memorias.id_itb = e2.id
INNER JOIN depto ON e1.id_depto = depto.id
ORDER BY memorias.id LIMIT 150";

            $result = mysqli_query($enlace, $sql);
            if (!$result) {
                die("Error en la consulta: " . mysqli_error($enlace));
            }

            while ($row = mysqli_fetch_object($result)) {
            ?>
                <tr>
                    <td><?php echo $row->nom_marca; ?></td>
                    <td><?php echo $row->modelo; ?></td>
                    <td><?php echo $row->serie; ?></td>
                    <td><?php echo $row->nom_cap; ?></td>
                    <td><?php echo $row->solicitante; ?></td>
                    <td><?php echo $row->nom_depto; ?></td>
                    <td><?php echo $row->nom_estado; ?></td>
                    <td><?php echo $row->nombre_entregador; ?></td>
                    <td><?php echo $row->fecha; ?></td>
                    <td><?php echo $row->obs; ?></td>

                    <td><a class="btn btn-success" href="/R_MEMORIAS/php/Editar_Memoria.php?id=<?php echo $row->id; ?>">Editar</a></td>
                    <td><a class="btn btn-danger" href="/R_MEMORIAS/php/Borrar_Memoria.php?id=<?php echo $row->id; ?>" onclick="return confirm('Estás seguro que deseas eliminar el registro?');">Eliminar</a></td>
                    <td><a class="btn btn-primary" href="/R_MEMORIAS/php/Imp_Memoria.php?id=<?php echo $row->id; ?>">Imprimir</a></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <td><a class="btn-editar" href="/R_MEMORIAS/php/Form_Memoria.php">Regresar</a></td>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tabla').DataTable();
        });
    </script>
</body>

</html>