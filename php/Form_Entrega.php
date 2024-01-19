<?php
include_once "../php/Sesion_Star.php";
include_once '../conexion/conexion2.php';
include_once "../php/plantilla3.php";
?>

<br>
<br>
<br>
<br>
<br>
<br>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <link rel="stylesheet" href="/R_MEMORIAS/css/stilos03.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Registro Entrega</title>
</head>

<body>

    <div class="container">
        <div class="form-header">
            <div class="header">

                <div style="position: relative;">
                    <img src="/R_Memorias/img/tvc.png" style="width: 100px; height: auto; position: absolute; top: 0; left: 0;">
                    <p style="position: relative; z-index: 1;"></p>
                </div>
                <div style="position: relative;">
                    <img src="/R_Memorias/img/eu.png" style="width: 100px; height: auto; position: absolute; top: 0; right: 0;">
                    <p style="position: relative; z-index: 1;"></p>
                </div>

                <h4 style="color: #ffffff;">Departamento ITBROADCAST</h4>
                <h4 style="color: #ffffff;">Registro de Entrega</h4>
            </div>
            <form action="/R_MEMORIAS/php/Reg_Entrega.php" method="POST" onsubmit="return validar();">
                <div class="wrap-input100 validate-input">
                    <br></br>
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <label for="fecha">Seleccione Fecha:</label>
                                        <input class="form-control" type="date" id="Fpres" required name="Fpres">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <label for="hora">Seleccione Hora:</label>
                                        <input class="form-control" type="time" id="Hpres" required name="Hpres">
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="form-group">
                    <label for="detalle">Detalles del equipo</label>
                    <textarea class="validate-input" id="detalle" name="detalle" rows="12" cols="100" placeholder="Detalles de Equipo/Accesorio" required></textarea>
                </div>
                <div class="form-group">
                    <table>
                        <tbody>

                            <td>
                                <div class="form-group">
                                    <label for="empleados">Recibido por:</label>
                                    <select class="form-control" type="text" id="id_emp" name="id_emp" placeholder="Seleccione el colaborador" class="input-48" required onchange="cargarDepartamento()">
                                        <option value="">Seleccionar</option>
                                        <?php
                                        $con = conexion();

                                        $sql = 'SELECT e.id, e.nom, d.nom_depto FROM empleados e INNER JOIN depto d ON e.id_depto = d.id';
                                        $query = mysqli_query($con, $sql);
                                        while ($row = mysqli_fetch_array($query)) {
                                            $idcap = $row['id'];
                                            $nomcap = $row['nom'];
                                            $nomDep = $row['nom_depto'];
                                        ?>
                                            <option value="<?php echo $idcap ?>" data-depto="<?php echo $nomDep ?>"><?php echo $nomcap ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <label for="dep">Departamento:</label>
                                    <input class="form-control" type="text" id="departamento" readonly>

                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <label for="itb">Entregada por:</label>
                                    <select class="form-control" type="text" id="id_itb" name="id_itb" placeholder="Seleccione el colaborador" class="input-48" required>
                                        <option value="">Seleccionar</option>
                                        < <?php
                                            $con = conexion();


                                            $sql = 'SELECT e.id, e.nom
                FROM empleados e
                INNER JOIN depto d ON e.id_depto = d.id
                WHERE d.nom_depto = "IT"';

                                            $query = mysqli_query($con, $sql);

                                            while ($row = mysqli_fetch_array($query)) {
                                                $idEmpleado = $row['id'];
                                                $nombreEmpleado = $row['nom'];
                                            ?> <option value="<?php echo $idEmpleado ?>"><?php echo $nombreEmpleado ?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                        </tbody>
                    </table>
                </div>
                <div class="wrap-input100 validate-input ">
                    <tbody>

                        <tr>
                            <td colspan="3">
                                <div class="form-group">
                                    <label style="text-align: left">Observaciones</label>
                                    <input class="form-control" type="text" id="nota" name="nota" placeholder="Opcional">
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    </table>
                </div>
                <br></br>
                <div style="grid-column: span 3; text-align: center;">
                    <input class="btn-submit" type="submit" value="Guardar Registro">
                </div>
            </form>
        </div>

        <script>
            function cargarDepartamento() {
                var empleadoSeleccionado = $("#id_emp").val();
                var departamentoSelect = $("#departamento");
                var depto = $("option:selected", "#id_emp").attr("data-depto");
                departamentoSelect.val(depto);
            }
        </script>
</body>

</html>