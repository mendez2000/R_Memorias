<?php
include_once "../php/Sesion_Star.php";
include_once "Function_Actualizar.php";
?>

<?php
$id = $_GET['id'];
$conexion =  mysqli_connect("localhost", "root", "", "activos");
$query = "DELETE FROM prestamo where id = '" . $id . "'";
$result = mysqli_query($conexion, $query);

if (!$result) {
    echo '<script>
           alert("El Registro NO pudo ser Eliminado");
           window.location = "/R_MEMORIAS/php/Cons_Prestamo.php";
           </script>';
} else {

    echo '<script>
            alert("El Registro fue ELIMINADO EXITOSAMENTE");
            window.location = "/R_MEMORIAS/php/Cons_Prestamo.php";
            </script>';
}
