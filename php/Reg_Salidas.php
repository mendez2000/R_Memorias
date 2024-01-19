<?php
include_once '../conexion/conexiones.php';
?>

<?php
session_start();

$ma = $_POST['det'];
$mo = $_POST['jef'];
$se = $_POST['dep'];
$ca = $_POST['fe'];
$pe = $_POST['di'];
$es = $_POST['em'];

$sqlCabecera = "INSERT INTO cabecera (detGrab, id_jefe, depto, fecha, dia, id_emp) VALUES ('$ma','$mo','$se','$ca','$pe','$es')";
$resultado = mysqli_query($conexion, $sqlCabecera);

if ($resultado === TRUE) {
    $idCabecera = mysqli_insert_id($conexion);

    $detEqui = $_POST["detEqui"];
    $marca = $_POST["marca"];
    $serie = $_POST["serie"];
    $cant = $_POST["cant"];
    $obs = $_POST["obs"];

    for ($i = 0; $i < count($detEqui); $i++) {
        $sqlDetalles = "INSERT INTO detalles (id_det, detEqui, marca, serie, cant, obs) VALUES (?, ?, ?, ?, ?, ?)";
        $stmtDetalles = $conexion->prepare($sqlDetalles);
        $stmtDetalles->bind_param("isssis", $idCabecera, $detEqui[$i], $marca[$i], $serie[$i], $cant[$i], $obs[$i]);
        $resultDetalles = $stmtDetalles->execute();

        if ($resultDetalles !== TRUE) {
            error_log("Error al insertar detalles: " . $stmtDetalles->error);
            echo "Ocurrió un error al procesar la solicitud. Por favor, inténtelo de nuevo más tarde.";
            break;
        }

        $stmtDetalles->close();
    }

    echo '<script>
        alert("El pase se registró EXITOSAMENTE");
        window.location = "/R_Memorias/php/Form_Salidas.php";
    </script>';
} else {
    error_log("Error al insertar cabecera: " . mysqli_error($conexion));
    echo "Ocurrió un error al procesar la solicitud. Por favor, inténtelo de nuevo más tarde.";
}

mysqli_close($conexion);
?>
