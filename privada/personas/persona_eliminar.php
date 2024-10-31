<?php session_start();
require_once("../../conexion.php");
$__id_persona = $_REQUEST["id_persona"];
$sql = $db->Prepare("SELECT *
                     FROM usuarios
                     WHERE id_persona = ?
                     AND estado <> 'X'
                   ");
$rs = $db->GetAll($sql, array($__id_persona));

if (!$rs) {
    $reg = array();
    $reg["estado"] = 'X';
    $reg["usuario"] = $_SESSION["sesion_id_usuario"];
    $rs1 = $db->AutoExecute("personas", $reg, "UPDATE", "id_persona='".$__id_persona."'");
    header("Location: personas.php");
    exit();
    
} else {
    $_SESSION['mensaje'] = "LA PERSONA TIENE HERENCIA NO SE PUEDE ELIMINAR.";
    $_SESSION['mensaje_tipo'] = "danger";
    header("Location: personas.php");
    exit();
}
?>
