<?php
include_once "../php/Sesion_Star.php";
include_once '../conexion/conexion2.php';
include_once '../conexion/conexion3.php';
include_once "../php/plantilla3.php";
include_once "function_Editar.php";
?>

<?php

$id = $_GET['id'];
if (isset($_POST['submit'])) {
    $field = array(
        "nom" => $_POST['nom'],
        'id_depto' => $_POST['dep'],
        'id_rol' => $_POST['rol']
    );

    $tbl = "empleados";
    edit($tbl, $field, 'id', $id);

    $id = $_GET['id'];


    $sql = "SELECT * FROM empleados WHERE id = $id";
    $resultMemoria = mysqli_query($enlace, $sql);

    if ($resultMemoria) {
        $row = mysqli_fetch_assoc($resultMemoria);
    } else {

        die("Error en la consulta: " . mysqli_error($enlace));
    }

    $result = mysqli_query($enlace, $sql);
    if ($result) {
        echo '<script>
            alert("El Registro se actualizó correctamente");
            window.location = "/R_Memorias/php/Cons_Colaborador.php";
          </script>';
    } else {
        echo '<script>
            alert("El Registro NO pudo ser actualizado");
            window.location = "/R_Memorias/php/Cons_Colaborador.php";
          </script>';

        die("Error en la consulta: " . mysqli_error($enlace));
    }
}


$sqlMemoria = "SELECT * FROM empleados WHERE id = $id";
$resultMemoria = mysqli_query($enlace, $sqlMemoria);
$row = mysqli_fetch_assoc($resultMemoria);

$sqlDeptos = "SELECT id, nom_depto FROM depto";
$resultDeptos = mysqli_query($enlace, $sqlDeptos);
$deptos = mysqli_fetch_all($resultDeptos, MYSQLI_ASSOC);

$sqlRol = "SELECT id, nom FROM roles";
$resultRol = mysqli_query($enlace, $sqlRol);
$deroles = mysqli_fetch_all($resultRol, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Editar Colaborador</title>
    <link rel="stylesheet" href="/R_Memorias/css/style_Empl.css">
</head>

<body>

    <main class="page-content">
        <div class="container-fluid">
            <section class="form-login">
                <h5>Editar Colaborador</h5>
                <form action="" method="post" class="form-grid">
                    <div class="form-group">
                        <div>

                            <label for="colaborador">Nombre del Empleado*</label>
                            <input class="controls" type="text" value="<?php echo $row['nom']; ?>" name="nom" placeholder="Opcional">
                            <br>

                            <div id="contact-form">
                                <label>Departamento*</label>
                                <br>
                                <select id="dep" name="dep" placeholder="Seleccione Rol" class="controls input-48" required>

                                    <?php
                                    foreach ($deptos as $depto) {
                                        $iddep = $depto['id'];
                                        $nomdep = $depto['nom_depto'];
                                        $selected = ($iddep == $row['id_depto']) ? 'selected' : '';
                                    ?>
                                        <option value="<?php echo $iddep ?>" <?php echo $selected; ?>><?php echo $nomdep ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <br>
                            <div id="contact-form">
                                <label>Funcion*</label><br>
                                <select id="rol" name="rol" placeholder="Seleccione Rol" class="controls input-48" required>

                                    <?php
                                    foreach ($deroles as $derol) {
                                        $idrol = $derol['id'];
                                        $nomrol = $derol['nom'];
                                        $selected = ($idrol == $row['id_rol']) ? 'selected' : '';
                                    ?>
                                        <option value="<?php echo $idrol ?>" <?php echo $selected; ?>><?php echo $nomrol ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                        </div>
                        <br>
                        <input class="buttons" type="submit" name="submit" value="Actualizar">
                </form>
            </section>
        </div>
    </main>
</body>

</html>