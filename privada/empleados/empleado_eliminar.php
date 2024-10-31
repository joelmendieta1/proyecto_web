<?php session_start();
require_once("../../conexion.php");

$id_empleado = $_REQUEST["id_empleado"];

/*LAS CONSULTAS SE TIENEN QUE HACER CON TODAS LAS TABLAS EN LAS QUE id_empleado ESTA COMO HERENCIA*/
$sql = $db->Prepare("SELECT *
                     FROM horarios
                     WHERE id_empleado = ?
                     AND estado <> 'X'
                   ");
$rs = $db->GetAll($sql, array($id_empleado));

$sql2 = $db->Prepare("SELECT *
                     FROM citas
                     WHERE id_empleado = ?
                     AND estado <> 'X'
                   ");
$rs1 = $db->GetAll($sql2, array($id_empleado));


if (!$rs AND !$rs1) {
    $reg = array();
    $reg["estado"] = 'X';
    $reg["usuario"] = $_SESSION["sesion_id_usuario"];
    $rs1 = $db->AutoExecute("empleados", $reg, "UPDATE", "id_empleado='".$id_empleado."'");
    header("Location: empleados.php");
    exit();
    
} else {
  $_SESSION['mensaje'] = "EL EMPLEADO TIENE HERENCIA NO SE PUEDE ELIMINAR.";
  $_SESSION['mensaje_tipo'] = "danger";
  header("Location: empleados.php");
  exit();
}
?>
