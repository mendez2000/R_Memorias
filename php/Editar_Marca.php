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
  <title>Editar Marca</title>

  <link rel="stylesheet" href="/R_Memorias/css/style_depto.css">
</head>

<body>

  <main class="page-content">
    <div class="container-fluid">
      <section class="form-login">
        <h5>Editar Marca</h5>

        <?php
        $id = $_GET['id'];
        select_id('marca', 'id', $id);
        ?>
        <form action="" method="post">
          <div>
            <td>
            <td>
              <label for="marca">Marca*</label>
              <input class="controls" type="text" value="<?php echo $row->nom_marca; ?>" name="nom_marca" placeholder="Opcional">
              <br><br>
              <input class="buttons" type="submit" name="submit" value="Actualizar">
          </div>
        </form>
        <?php
        if (isset($_POST['submit'])) {
          $field = array(
            "nom_marca" => $_POST['nom_marca']
          );
          $tbl = "marca";
          $result = edit($tbl, $field, 'id', $id);
          if ($result) {
            echo '<script>
                  alert("El Registro se actualizó correctamente");
                  window.location = "/R_Memorias/php/Cons_Marca.php";
                </script>';
          } else {
            echo '<script>
                  alert("El Registro NO pudo ser actualizado");
                  window.location = "/R_Memorias/php/Cons_Marca.php";
                </script>';
          }
        }
        ?>
    </div>
</body>

</html>