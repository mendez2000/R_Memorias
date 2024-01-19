<?php
include_once "../php/Sesion_Star.php";
include_once '../conexion/conexion3.php';
include_once "../php/plantilla4.php";
include_once "Function_Actualizar.php";
?>

<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Cons Colaboradores</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/R_MEMORIAS/css/stilu.css">
    <link rel="stylesheet" href="/R_MEMORIAS/css/stilos4.css">
    <link rel="stylesheet" href="/R_MEMORIAS/css/menu11.css">
    <link rel="stylesheet" type="text/css" href="/R_MEMORIAS/css/min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>

<body>

    <div class="container">
        <h2>Consulta Colaboradores</h2>
        <br>
        <table class="table table-striped" id="tabla">
            <thead>
                <tr>
                    <th width="auto">Nombre Apellido</th>
                    <th>Departamento</th>
                    <th>Funcion</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>

            </thead>
            <tbody>
                <?php
                $sql = "SELECT empleados.id, empleados.nom, depto.nom_depto AS nom_depto, roles.nom AS nom_rol
FROM empleados
INNER JOIN depto ON empleados.id_depto = depto.id
INNER JOIN roles ON empleados.id_rol = roles.id
ORDER BY empleados.id LIMIT 150";


                $result = mysqli_query($enlace, $sql);
                while ($row = mysqli_fetch_object($result)) {
                ?>
                    <tr>
                        <td><?php echo $row->nom; ?></td>
                        <td><?php echo $row->nom_depto; ?></td>
                        <td><?php echo $row->nom_rol; ?></td>
                        <td><a class="btn btn-success" href="/R_MEMORIAS/php/Editar_Colaborador.php?id=<?php echo $row->id; ?>">Editar</a></td>
                        <td><a class="btn btn-danger" href="/R_MEMORIAS/php/Borrar_Colaborador.php?id=<?php echo $row->id; ?>" onclick="return confirm('Estás seguro que deseas eliminar el registro?');">Eliminar</a></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <td><a class="btn-editar" href="/R_MEMORIAS/php/Form_Empl.php">Regresar</a></td>
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