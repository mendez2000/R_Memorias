<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "activos";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    session_start();

    $ma = $_POST['det'];
    $mo = $_POST['jef'];
    $se = $_POST['dep'];
    $ca = $_POST['fe'];
    $pe = $_POST['di'];
    $es = $_POST['em'];

    $sqlCabecera = "INSERT INTO cabecera (detGrab, id_jefe, depto, fecha, dia, id_emp) VALUES (?, ?, ?, ?, ?, ?)";
    $stmtCabecera = $conn->prepare($sqlCabecera);
    $stmtCabecera->bind_param("ssssss", $ma, $mo, $se, $ca, $pe, $es);
    $resultCabecera = $stmtCabecera->execute();

    if ($resultCabecera === TRUE) {
        $idCabecera = $stmtCabecera->insert_id;

        $detEqui = $_POST["detEqui"];
        $marca = $_POST["marca"];
        $serie = $_POST["serie"];
        $cant = $_POST["cant"];
        $obs = $_POST["obs"];

        for ($i = 0; $i < count($detEqui); $i++) {
            $sqlDetalles = "INSERT INTO detalles (id_det, detEqui, marca, serie, cant, obs) VALUES (?, ?, ?, ?, ?, ?)";
            $stmtDetalles = $conn->prepare($sqlDetalles);
            $stmtDetalles->bind_param("isssis", $idCabecera, $detEqui[$i], $marca[$i], $serie[$i], $cant[$i], $obs[$i]);
            $resultDetalles = $stmtDetalles->execute();

            if ($resultDetalles !== TRUE) {
                error_log("Error al insertar detalles: " . $stmtDetalles->error);
                echo "Ocurrió un error al procesar la solicitud. Por favor, inténtelo de nuevo más o tarde.";
                break;
            }

            $stmtDetalles->close();
        }
        echo '<script>
            alert("El pase se registró EXITOSAMENTE");
            window.location = "/R_Memorias/php/Form_Salidas.php";
        </script>';
    }

    $stmtCabecera->close();
    $conn->close();
}
