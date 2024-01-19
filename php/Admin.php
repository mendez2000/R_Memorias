<?php
include_once "../php/Sesion_Star.php"
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/R_MEMORIAS/css/stilos.css">
  <title>Login</title>
  <script src="/R_MEMORIAS/js/validar.js"></script>
</head>

<body>

  <section class="form-register">
    <div class="container justify-content-center mt5">
      <h1 class="text-center">Super Administrador<br></br></h1>
    </div>

    <form action="/R_MEMORIAS/php/Valiadar_Admin.php" method="POST" onsubmit="return validar();">

      <label>Ingrese su Usuario*</label>
      <input class="controls" type="text" id="nom" name="nom" placeholder="Ingrese su Usuario" class="input-48" required>
      <label>Ingrese su Contraseña*</label>
      <input class="controls" type="password" id="pas" name="pas" placeholder="Ingrese su Contraseña" class="input-48" required>

      <input class="botons" type="submit" value="Ingresar">

      <p><a href="/R_Memorias/index.php">Login</a> || <a href="/R_Memorias/php/form_Admin.php">Nuevo Administrador</a></p>

  </section>
  </form>
</body>

</html>