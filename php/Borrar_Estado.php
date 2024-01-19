<?php
include_once "../php/Sesion_Star.php";
include_once "Function_Actualizar.php";

$id = $_GET['id'];

// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "activos");

// Verificar si la marca está en uso en la tabla 'memorias'
$query_check_memorias = "SELECT COUNT(*) AS total FROM memorias WHERE id_estado = '$id'";
$result_check_memorias = mysqli_query($conexion, $query_check_memorias);

if ($result_check_memorias) {
    $row_memorias = mysqli_fetch_assoc($result_check_memorias);

    // Si la marca está en uso en 'memorias', mostrar un mensaje y salir
    if ($row_memorias['total'] > 0) {
        echo '<script>
        alert("No puede eliminar el estado, está en uso en el registro de memorias.");
            window.location = "/R_MEMORIAS/php/Cons_Estado.php";
            </script>';
        exit;
    }
} else {
    echo '<script>
    alert("Error al verificar el uso del estado en la tabla de memorias.");
        window.location = "/R_MEMORIAS/php/Cons_Estado.php";
        </script>';
    exit;
}

$query_delete = "DELETE FROM estados WHERE id = '$id'";
$result_delete = mysqli_query($conexion, $query_delete);

if ($result_delete) {
    echo '<script>
        alert("El Registro fue ELIMINADO EXITOSAMENTE");
        window.location = "/R_MEMORIAS/php/Cons_Estado.php";
        </script>';
} else {
    echo '<script>
        alert("El Registro NO pudo ser Eliminado");
        window.location = "/R_MEMORIAS/php/Cons_Estado.php";
        </script>';
}
?>
