<?php session_start();
require_once("../../conexion.php");
$id_promocion = $_REQUEST["id_promocion"];
$sql = $db->Prepare("SELECT *
                     FROM usuarios
                     WHERE id_promocion = ?
                     AND estado <> 'X'
                   ");
$rs = $db->GetAll($sql, array($id_promocion));

if (!$rs) {
    $reg = array();
    $reg["estado"] = 'X';
    $reg["usuario"] = $_SESSION["sesion_id_usuario"];
    $rs1 = $db->AutoExecute("promociones", $reg, "UPDATE", "id_promocion='".$id_promocion."'");
    header("Location: promociones.php");
    exit();
    
} else {
    $_SESSION['mensaje'] = "LA PROMOCION TIENE HERENCIA NO SE PUEDE ELIMINAR.";
    $_SESSION['mensaje_tipo'] = "danger";
    header("Location: promociones.php");
    exit();
}
?>
