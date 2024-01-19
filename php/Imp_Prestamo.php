<?php
include_once "../php/Sesion_Star.php";
include_once '../conexion/conexion3.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];


    $sql = "SELECT prestamo.id,
    prestamo.Fpres,
    prestamo.Hpres,
    prestamo.detalle,
    e1.nom AS solicitante,
    (SELECT depto.nom_depto FROM depto WHERE depto.id = e1.id_depto) AS nom_depto_solicitante,
    e2.nom AS entregador,
    prestamo.Fdev,
    prestamo.Hdev,
    (SELECT e3.nom FROM empleados AS e3 WHERE e3.id = prestamo.Entr) AS nombre_entregador,
    (SELECT e4.nom FROM empleados AS e4 WHERE e4.id = prestamo.itbrec) AS nombre_itbrec,
    prestamo.nota
    FROM prestamo
    INNER JOIN empleados AS e1 ON prestamo.id_empleados = e1.id
    INNER JOIN empleados AS e2 ON prestamo.id_itb = e2.id
    INNER JOIN depto ON e1.id_depto = depto.id
    WHERE prestamo.id = $id";

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
    <title>Imp Préstamo</title>
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
        <h2 style="font-size: 20px;">Comprobante Prestamo de Equipo/Accesorios</h2>

        <script type="text/javascript">
            function imprimir() {
                if (window.print) {
                    window.onafterprint = function() {
                        window.location.href = '/R_MEMORIAS/php/Cons_Prestamo.php';
                    };

                    window.print();
                } else {
                    alert("La función de impresión no está soportada por su navegador.");
                }
            }
        </script>

        <body onload="imprimir();">

            <div>
                <h2 align="center" style="font-family: courier, arial, helvetica; color: #000000;">
                </h2>
                <h2 align="center" style="font-family: courier, arial, helvetica; color: #000000;">

                </h2>
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
                <h4>Por medio de la presente se hace entrega en condición de préstamo del equipo y/o accesorio que se detalla a continuación:</h4>
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
                                        <h5 style="text-align: left; margin: 0 0 0.5em 0;">Solicitado por el Departamento de: <input class="controls" value="<?php echo $row->nom_depto_solicitante; ?>" style="display: inline;  border: none;width: 100px; margin-right: 20px;"></h5>
                                    </td>
                                </tr>
                        </table>
                        <table>
                            <td>
                                <h5 style="text-align: left; margin: 0 0 0.5em 0;">Recibido por: <input class="controls" value="<?php echo $row->solicitante; ?>" style="display: inline;  border: none;width: 100px; margin-right: 20px;"></h5>
                                <h5 style="text-align: left; margin: 0 0 0.5em 0;">Firma de Recibido:
                            </td>
                            <td>
                                <h5 style="text-align:  left; margin: 0 0 0.5em 0;">Entregado por: <input class="controls" value="<?php echo $row->entregador; ?>" style="display: inline;  border: none;width: 100px; margin-right: 20px;"></h5>
                                <h5 style="text-align: left; margin: 0 0 0.5em 0;">Firma de Entrega:
                            </td>

                            </tbody>
                        </table>


















                        </tbody>
                        </table>
                    </div>
                </div>
                <h4 style="text-align: left; margin: 0 0 0.5em 0;">Nota: Se hace constar que el equipo se entrega en óptimas condiciones y ha sido revisado por quien lo recibe.</h4>


                <h2 style="font-size: 20px;">DEVOLUCION DEL EQUIPO/ACCESORIO</h2>











                <table border="">
                    <tbody>
                        <tr>
                            <td>
                                <h5 style="display: inline; margin-right: 10px;">Fecha Devolución:</h5>
                                <input class="controls" value="<?php echo $row->Fdev; ?>" style="display: inline;  border: none;width: 100px; margin-right: 20px;">
                                <h5 style="display: inline; margin-right: 10px;">Hora Devolución:</h5>
                                <input class="controls" value="<?php echo $row->Hdev; ?>" style="display: inline; border: none; width: 100px;">
                            </td>
                        </tr>
                    </tbody>
                </table>














                <table>
                    <td>
                        <h5 style="text-align: left; margin: 0 0 0.5em 0;">Entregado por: <input class="controls" value="<?php echo $row->nombre_entregador; ?>" style="text-align: center;"></h5>
                        <h5 style="text-align: left; margin: 0 0 0.5em 0;">Firma de Entrega:
                    </td>
                    <td>
                        <h5 style="text-align: left; margin: 0 0 0.5em 0;">Recibido por: <input class="controls" value="<?php echo $row->nombre_itbrec; ?>" style="text-align: center;"></h5>
                        <h5 style="text-align: left; margin: 0 0 0.5em 0;">Firma de Recibido:
                    </td>
                </table>


                <h4 align="left">Observaciones</h4>
                <textarea name="detalle" id="autoResize" readonly><?php echo $row->nota; ?></textarea>

            </div>
        </body>

</html>