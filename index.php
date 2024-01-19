<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Login</title>
  <link rel="stylesheet" href="/R_MEMORIAS/css/style_login.css">

  <section class="form-login">
    <title>Login</title>
    <script src="/R_MEMORIAS/js/validar.js"></script>
</head>

<body>
  <h5>Inicio de Sesión</h5>
  </div>

  <form action="/R_MEMORIAS/php/Validar_Usuario.php" method="POST" onsubmit="return validar();">

    <label>Ingrese su Usuario*</label></br>
    <input class="controls" type="text" id="nom" name="nom" value="" placeholder="Usuario" class="input-48" required>
    <label>Ingrese su Contraseña*</label></br>
    <input class="controls" type="password" id="pas" name="pas" value="" placeholder="Contraseña" class="input-48" required>
    </br></br>
    <input class="buttons" type="submit" value="Ingresar">
    </section>

</body>

</html>