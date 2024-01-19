<?php
include_once "../php/Sesion_Star.php";
include_once "Function_Actualizar.php";

$id = $_GET['id'];

$conexion = mysqli_connect("localhost", "root", "", "activos");

$query_check_memorias = "SELECT COUNT(*) AS total FROM memorias WHERE id_marca = '$id'";
$result_check_memorias = mysqli_query($conexion, $query_check_memorias);

if ($result_check_memorias) {
    $row_memorias = mysqli_fetch_assoc($result_check_memorias);

    if ($row_memorias['total'] > 0) {
        echo '<script>
        alert("No puede eliminar esta marca, está en uso en otros registros.");
            window.location = "/R_MEMORIAS/php/Cons_Marca.php";
            </script>';
        exit;
    }
} else {
    echo '<script>
    alert("Error al verificar el uso de la marca en las tablas.");
        window.location = "/R_MEMORIAS/php/Cons_Marca.php";
        </script>';
    exit;
}

$query_delete = "DELETE FROM marca WHERE id = '$id'";
$result_delete = mysqli_query($conexion, $query_delete);

if ($result_delete) {
    echo '<script>
        alert("El Registro fue ELIMINADO EXITOSAMENTE");
        window.location = "/R_MEMORIAS/php/Cons_Marca.php";
        </script>';
} else {
    echo '<script>
        alert("El Registro NO pudo ser Eliminado");
        window.location = "/R_MEMORIAS/php/Cons_Marca.php";
        </script>';
}
