<?php
include_once "../php/Sesion_Star.php";
include_once '../conexion/conexion2.php';
include_once "../php/plantilla3.php";
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Registro Estado</title>
  <link rel="stylesheet" href="/R_Memorias/css/style_depto.css">
</head>

<body>

  <main class="page-content">
    <div class="container-fluid">
      <section class="form-login">
        <h5>Registro Estado</h5>
        <form action="/R_Memorias/php/Reg_Estado.php" method="POST" onsubmit="return validar();">
          <label for="estado">Estado*</label>
          <input class="controls" type="text" id="esta" name="esta" placeholder="Nombre del Estado" class="input-48" required>
          </select></br></br>
          <input class="buttons" type="submit" value="Guardar">
      </section>

    </div>
  </main>
  </div>
</body>

</html>