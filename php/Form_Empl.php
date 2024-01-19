<?php
include_once "../php/Sesion_Star.php";
include_once '../conexion/conexion2.php';
include_once "../php/plantilla3.php";
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Colaborador</title>
  <link rel="stylesheet" href="/R_Memorias/css/style_emp.css">
</head>

<body>

  <main class="page-content">
    <div class="container-fluid">
      <section class="form-login">
        <h5>Registro Colaborador</h5>
        <form action="/R_Memorias/php/Reg_Empl.php" method="POST" onsubmit="return validar();">
          <label for="empleados">Nombre del Empleado*</label>
          <input class="controls" type="text" id="emp" name="emp" placeholder="Nombre y Apellido" class="input-48" required>

          <div id="contact-form">
            <label>Departamento*</label></br>
            <select class="controls" type="text" id="dep" name="dep" placeholder="Seleccione depto" class="input-48" required>
              <option value="">Seleccionar</option>
              <?php
              $con = conexion();

              $sql = 'SELECT * FROM depto';
              $query = mysqli_query($con, $sql);
              while ($row = mysqli_fetch_array($query)) {
                $iddep = $row['id'];
                $nomdep = $row['nom_depto'];
              ?>
                <option value="<?php echo $iddep ?>"><?php echo $nomdep ?></option>
              <?php
              }
              ?>
            </select>
            </br>
            <br>

            <div class="wrap-input100 validate-input ">
              <label>Funcion*</label>

              <select class="controls" type="text" id="rol" name="rol" placeholder="" class="input-48" required>
                <option value="">Seleccionar</option>
                <?php
                $con = conexion();

                $sql = 'SELECT * FROM roles';
                $query = mysqli_query($con, $sql);
                while ($row = mysqli_fetch_array($query)) {
                  $idrol = $row['id'];
                  $nomrol = $row['nom'];
                ?>
                  <option value="<?php echo $idrol ?>"><?php echo $nomrol ?></option>

                <?php
                }
                ?>
              </select>
              </br></br>
              <input class="buttons" type="submit" value="Guardar">

      </section>
    </div>
  </main>
  </div>
</body>

</html>