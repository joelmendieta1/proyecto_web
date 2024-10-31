<?php 
session_start();
require_once("../../conexion.php");

// Obtener el ID de la categoría de servicio a eliminar
$id_categoria_servicio = $_REQUEST["id_categoria_servicio"];

// Verificar si la categoría está siendo utilizada en algún otro lugar (si aplica).
// Aquí se puede agregar una consulta si hay relaciones a verificar antes de eliminar
$sql = $db->Prepare("SELECT *
                     FROM detalles_servicios
                     WHERE id_categoria_servicio = ?
                     AND estado <> 'X'
                   ");
$rs = $db->GetAll($sql, array($id_categoria_servicio));

// Si no hay registros asociados, proceder a marcar la categoría como eliminada
if (!$rs) {
    $reg = array();
    $reg["estado"] = 'X'; // Estado 'X' indica eliminado
    $reg["usuario"] = $_SESSION["sesion_id_usuario"]; // Usuario que realiza la acción

    // Actualizar el estado de la categoría a 'X' (eliminado)
    $rs1 = $db->AutoExecute("categorias_servicios", $reg, "UPDATE", "id_categoria_servicio='".$id_categoria_servicio."'");
    
    // Redirigir al listado de categorías de servicios
    header("Location: categorias_servicios.php");
    exit();
    
} else {
    // Si la categoría está en uso, mostrar mensaje de error
    echo "<script type='text/javascript'>
    alert('No se puede eliminar, la categoría está en uso.');
    window.location.href = 'categorias_servicios.php';
    </script>";
}
?>

