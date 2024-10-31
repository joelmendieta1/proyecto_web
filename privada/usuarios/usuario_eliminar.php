<?php session_start();
require_once("../../conexion.php");
$id_cliente = $_REQUEST["id_cliente"];
$sql = $db->Prepare("SELECT *
                     FROM citas
                     WHERE id_cliente = ?
                     AND estado <> 'X'
                   ");
$rs = $db->GetAll($sql, array($id_cliente));

if (!$rs) {
    $reg = array();
    $reg["estado"] = 'X';
    $reg["usuario"] = $_SESSION["sesion_id_usuario"];
    $rs1 = $db->AutoExecute("clientes", $reg, "UPDATE", "id_cliente='".$id_cliente."'");
    header("Location: clientes.php");
    exit();
    
} else {
  echo "<script type='text/javascript'>
  alert('Fallo al eliminar');
  window.location.href = 'clientes.php';
</script>";
}
?>
