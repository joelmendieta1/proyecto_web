<?php session_start();
require_once("../../conexion.php");
$id_propietario = $_REQUEST["id_propietario"];
$sql = $db->Prepare("SELECT *
                     FROM usuarios
                     WHERE id_propietario = ?
                     AND estado <> 'X'
                   ");
$rs = $db->GetAll($sql, array($id_propietario));

if (!$rs) {
    $reg = array();
    $reg["estado"] = 'X';
    $reg["usuario"] = $_SESSION["sesion_id_usuario"];
    $rs1 = $db->AutoExecute("propietario", $reg, "UPDATE", "id_propietario='".$id_propietario."'");
    header("Location: propietario.php");
    exit();
    
} else {
    $_SESSION['mensaje'] = "EL PROPIETARIO TIENE HERENCIA NO SE PUEDE ELIMINAR.";
    $_SESSION['mensaje_tipo'] = "danger";
    header("Location: propietario.php");
    exit();
}
?>
