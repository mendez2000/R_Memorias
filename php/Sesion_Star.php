<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    echo
    '<script>
alert("Para poder ingresar debes iniciar sesión");
window.location = "/R_Memorias/index.php";
</script>';
    session_destroy();
}
