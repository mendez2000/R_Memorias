<?php
include_once "../php/Sesion_Star.php";
include_once '../conexion/conexion2.php';
include_once "../php/plantilla3.php";
include_once "function_Editar.php";
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Editar Roles</title>
  <link rel="stylesheet" href="/R_Memorias/css/style_depto.css">
</head>

<body>

  <main class="page-content">
    <div class="container-fluid">
      <section class="form-login">
        <h4>Departamento ITBROADCAST</h4>
        <h5>Editar Roles</h5>

        <?php
        $id = $_GET['id'];
        select_id('roles', 'id', $id);
        ?>
        <form action="" method="post">
          <div>
            <td>
            <td>
              <label for="rol">Nombre del Rol*</label>
              <input class="controls" type="text" value="<?php echo $row->nom; ?>" name="nom" placeholder="Opcional">

              </br></br>
              <input class="buttons" type="submit" name="submit" value="Actualizar">
          </div>
        </form>
        <?php
        if (isset($_POST['submit'])) {
          $field = array(
            "nom" => $_POST['nom']
          );

          $tbl = "roles";
          edit($tbl, $field, 'id', $id);

          if (!$result) {
            echo '<script>
            alert("El Registro se actualizó correctamente");
            window.location = "/R_Memorias/php/Cons_Roles.php";
          </script>';
          } else {
            echo '<script>
            alert("El Registro NO pudo ser actualizado");
            window.location = "/R_Memorias/php/Cons_Roles.php";
          </script>';
          }
        }

        ?>
    </div>
</body>

</html>