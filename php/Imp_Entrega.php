<?php
include_once "../php/Sesion_Star.php";
include_once '../conexion/conexion3.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

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
    entregas.nota FROM entregas
    INNER JOIN empleados AS e1 ON entregas.id_emp = e1.id
    INNER JOIN empleados AS e2 ON entregas.id_itb = e2.id
    WHERE entregas.id = $id";

    $result = mysqli_query($enlace, $sql);

    if (!$result) {
        die("Error en la consulta: " . mysqli_error($enlace));
    }

    $row = mysqli_fetch_object($result);
} else {
    echo "ID no válido.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <div style="position: relative;">
        <img src="/R_Memorias/img/tvc01.png" style="width: 100px; height: auto; position: absolute; top: 0; left: 0;">
        <p style="position: relative; z-index: 1;"></p>
    </div>
    <link rel="stylesheet" href="/R_MEMORIAS/css/pint_prestamo.css">
    <title>Imp Entrega</title>
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
        <h2 style="font-size: 20px;">Televicentro</h2>
        <h2 style="font-size: 20px;">Comprobante Entrega de Equipo/Accesorios</h2>

        <script type="text/javascript">
            function imprimir() {
                if (window.print) {

                    window.onafterprint = function() {

                        window.location.href = '/R_MEMORIAS/php/Cons_Entrega.php';
                    };

                    window.print();
                } else {
                    alert("La función de impresión no está soportada por su navegador.");
                }
            }
        </script>

        <body onload="imprimir();">
            <div>
                <h2 align="center" style="font-family: courier, arial, helvetica; color: #000000;"></h2>
                <h2 align="center" style="font-family: courier, arial, helvetica; color: #000000;"></h2>
            </div>

            <table border="">
                <tbody>
                    <tr>
                        <td>
                            <h5 style="display: inline; margin-right: 10px;">Fecha de Entrega:</h5>
                            <input class="controls" value="<?php echo $row->Fpres; ?>" style="display: inline;  border: none;width: 100px; margin-right: 20px;">
                            <h5 style="display: inline; margin-right: 10px;">Hora de Entrega:</h5>
                            <input class="controls" value="<?php echo $row->Hpres; ?>" style="display: inline; border: none; width: 100px;">
                        </td>
                    </tr>
                </tbody>
            </table>

            <div style="text-align: left;">
                <h4>Por medio de la presente se hace entrega del siguiente equipo que se detalla a continuación:</h4>
                <table>
                    <td>
                        <textarea name="detalle" id="autoResize" readonly><?php echo $row->detalle; ?></textarea>
                    </td>
                </table>
                <div>
                    <div class="controls">
                        <table>
                            <tbody>
                                <tr>
                                    <td>
                                        <h5 style="text-align: left;">Recibido por:</h5>
                                        <input type="text" value="<?php echo $row->solicitante; ?>" readonly style="width: 100%; border: none; text-align: left;">
                                    </td>
                                    <td>
                                        <h5 style="text-align: left;">Departamento Solicitante:</h5>
                                        <input class="controls" value="<?php echo $row->nom_depto_solicitante; ?>" readonly style="width: 100%; border: none; text-align: left;">
                                    </td>
                                    <td>
                                        <div class="dropDownSelect2"></div>
                                        <h5 style="text-align: left;">Entregado por:</h5>
                                        <input class="controls" type="text" value="<?php echo $row->nombre_entregador; ?>" readonly style="width: 100%; border: none; text-align: left;">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <h4>Nota: Se hace constar que el equipo se entrega en óptimas condiciones y ha sido revisado por quien lo recibe.</h4>
                <br>
                <h4 align="left">Observaciones</h4>
                <textarea name="detalle" id="autoResize" readonly><?php echo $row->nota; ?></textarea>
                <br>
                <h4 align="center">_____________________________________</h4>
                <h3 align="center">Firma de Recibido</h3>
            </div>
        </body>
    </div>
</body>

</html>