<?php
include_once "../php/Sesion_Star.php";
include_once '../conexion/conexion3.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT memorias.id,
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
WHERE memorias.id = $id";

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
    <meta charset="utf-8">

    <div style="position: relative;">
        <img src="/R_Memorias/img/tvc01.png" style="width: 100px; height: auto; position: absolute; top: 0; left: 0;">
        <p style="position: relative; z-index: 1;"></p>
    </div>

    <link rel="stylesheet" href="/R_MEMORIAS/css/pint_entrega.css">
    <title>Imp Memoria</title>

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
        <h2 style="font-size: 20px;">ITBROADCAST</h2>
        <h2 style="font-size: 20px;">Comprobante Entrega de Memoria</h2>


        <script type="text/javascript">
            function imprimir() {
                if (window.print) {

                    window.onafterprint = function() {

                        window.location.href = '/R_MEMORIAS/php/Cons_Memoria.php';
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
            <table>
                <tbody>
                    <tr>
                        <td>
                            <span>
                                <h5>Marca</h5>
                            </span>
                            <input class="controls" value="<?php echo $row->nom_marca; ?>">
                        </td>
                        <td>
                            <span>
                                <h5>Modelo</h5>
                            </span>
                            <input class="controls" value="<?php echo $row->modelo; ?>">
                        </td>
                        <td>
                            <span>
                                <h5>Serie</h5>
                            </span>
                            <input class="controls" value="<?php echo $row->serie; ?>">
                        </td>
                        <td>
                            <span>
                                <h5>Capacidad</h5>
                            </span>
                            <input class="controls" value="<?php echo $row->nom_cap; ?>">
                        </td>
                    </tr>
                    <div style="text-align: center;">
                        <table>
                            <tr>
                                <td>
                                    <span>
                                        <h5>Recibida por:</h5>
                                    </span>
                                    <input class="controls" value="<?php echo $row->solicitante; ?>">
                                </td>
                                <td>
                                    <span>
                                        <h5>Departamento</h5>
                                    </span>
                                    <input class="controls" value="<?php echo $row->nom_depto_solicitante; ?>">
                                </td>
                                <td>
                                    <span>
                                        <h5>Estado</h5>
                                    </span>
                                    <input class="controls" value="<?php echo $row->nom_estado; ?>">
                                </td>
                            </tr>
                            <div class="wrap-input100 validate-input ">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <span>
                                                    <h5>Entregada por:</h5>
                                                </span>
                                                <input class="controls" value="<?php echo $row->nombre_entregador; ?>">
                                            </td>
                                            <td>
                                                <span>
                                                    <h5>Fecha de Entrega:</h5>
                                                </span>
                                                <input class="controls" value="<?php echo $row->fecha; ?>">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <h4 style="text-align: left;" class="note">Nota: Se hace constar que el equipo se entrega en óptimas condiciones y ha sido revisado por quien lo recibe.</h4>

                            <div style="text-align: left;">
                                <h4 align="left">Observaciones</h4>
                                <name="detalle" id="autoResize" readonly style="text-align: left;"><?php echo $row->obs; ?>
                            </div>
                            <br></br>
                            <h4 align="center">_____________________________________</h4>

                            <h3 align="center">Firma de Recibido</h3>
        </body>

</html>