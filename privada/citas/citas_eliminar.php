<?php
session_start();
require_once("../../conexion.php");

$id_cita = $_REQUEST["id_cita"];

// Comprobar si hay citas relacionadas
$sql = $db->Prepare("SELECT *
                     FROM detalles_servicios
                     WHERE id_cita = ?
                     AND estado <> 'X'
                   ");
$rs = $db->GetAll($sql, array($id_cita));

if (!$rs) {
    $reg = array();
    $reg["estado"] = 'X';
    $reg["usuario"] = $_SESSION["sesion_id_usuario"];
    $rs1 = $db->AutoExecute("citas", $reg, "UPDATE", "id_cita='".$id_cita."'");

    header("Location: citas.php");
    exit();
} else {
    echo "<script type='text/javascript'>
    alert('No se puede eliminar la cita, tiene detalles relacionados.');
    window.location.href = 'citas.php';
    </script>";
}
?>
