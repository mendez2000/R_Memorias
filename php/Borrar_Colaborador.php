<?php
include_once "../php/Sesion_Star.php";
include_once "Function_Actualizar.php";

$id = $_GET['id'];
$conexion =  mysqli_connect("localhost", "root", "", "activos");

$query_info_empleado = "SELECT id_depto, id_rol FROM empleados WHERE id = $id";
$result_info_empleado = mysqli_query($conexion, $query_info_empleado);
$row_info_empleado = mysqli_fetch_assoc($result_info_empleado);

if ($row_info_empleado['id_depto'] == 11 || $row_info_empleado['id_rol'] == 9) {
    echo '<script>
    alert("No puede eliminar el empleado porque tiene asignaciones en el sistema.");
           window.location = "/R_MEMORIAS/php/Cons_Colaborador.php";
           </script>';
    exit;
} else {
    $tablas_relacionadas = ['memorias', 'cabecera', 'entregas', 'prestamo'];
    $registros_en_uso = false;

    foreach ($tablas_relacionadas as $tabla) {
        $columna_id = '';

        switch ($tabla) {
            case 'entregas':
                $columna_id = 'id_emp';
                break;
            case 'prestamo':
                $columna_id = 'id_empleados';
                break;
            case 'cabecera':
                $columna_id = 'id_emp';

                break;
            case 'memorias':
                $columna_id = 'id_empleados';

                break;
        }

        if (!empty($columna_id)) {
            $query_verificar_relacion = "SELECT COUNT(*) as total FROM $tabla WHERE $columna_id = $id";
            $result_relacion = mysqli_query($conexion, $query_verificar_relacion);
            $row_relacion = mysqli_fetch_assoc($result_relacion);

            if ($row_relacion['total'] > 0) {
                $registros_en_uso = true;
                break;
            }
        }
    }
}

if ($registros_en_uso) {
    echo '<script>
           alert("No se puede eliminar el empleado, porque está en uso en otros Registros.");
           window.location = "/R_MEMORIAS/php/Cons_Colaborador.php";
           </script>';
} else {
    $query_eliminar_empleado = "DELETE FROM empleados WHERE id = $id";
    $result = mysqli_query($conexion, $query_eliminar_empleado);

    if (!$result) {
        echo '<script>
               alert("El Registro NO pudo ser Eliminado");
               window.location = "/R_MEMORIAS/php/Cons_Colaborador.php";
               </script>';
    } else {
        echo '<script>
        alert("El Registro fue ELIMINADO EXITOSAMENTE");
        window.location = "/R_MEMORIAS/php/Cons_Colaborador.php";
        </script>';
    }
}
