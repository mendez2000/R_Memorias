<?php
include_once "../php/Sesion_Star.php";
include_once '../conexion/conexion3.php';
include_once "../php/plantilla4.php";
include_once "Function_Actualizar.php";
?>

<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Cons Capacidades</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="/R_MEMORIAS/css/stilu.css">
	<link rel="stylesheet" href="/R_MEMORIAS/css/stilos4.css">
	<link rel="stylesheet" href="/R_MEMORIAS/css/menu11.css">
	<link rel="stylesheet" type="text/css" href="/R_MEMORIAS/css/min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>

<body>

	<div class="container">
		<h2>Consulta Capacidades</h2>
		<br>
		<table class="table table-striped">
			<table id="tabla">
				<thead>
					<tr>

						<th width="auto">Capacidades</th>
						<th>Editar</th>
						<th>Eliminar</th>
					</tr>
				</thead>
				<tbody>

					<?php
					$sql = "SELECT * FROM capacidad ORDER By id LIMIT 150";

					$result = db_query($sql);
					while ($row = mysqli_fetch_object($result)) {
					?>
						<tr>
							<td><?php echo $row->nom_cap; ?></td>

							<td><a class="btn btn-success" href="/R_MEMORIAS/php/Editar_Capacidad.php?id=<?php echo $row->id; ?>">Editar</a>
							<td><a class="btn btn-danger" href="/R_MEMORIAS/php/Borrar_Capacidad.php?id=<?php echo $row->id; ?>" onclick="return confirm('Estás seguro que deseas eliminar el registro?');">Eliminar</a>
						</tr>
					<?php
					}
					?>
			</table>
			<td><a class="btn-editar" href="/R_MEMORIAS/php/Form_Cap.php">Regresar</a></td>
			<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
			<script src="//cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
			<script>
				$(document).ready(function() {
					$('#tabla').DataTable();
				});
			</script>
</body>

</html>