<?php
session_start();
require_once("../../conexion.php");

$id_promocion = $_POST["id_promocion"];

$descuento = $_POST["descuento"];
$descripcion = $_POST["descripcion"];
$fecha_inicio = $_POST["fecha_inicio"];
$fecha_fin = $_POST["fecha_fin"];

if(($descuento!="") and  ($descripcion!="") ){
   $reg = array();
   $reg["id_peluqueria"] = 1;
   $reg["descuento"] = $descuento;
   $reg["descripcion"] = $descripcion;
   $reg["fecha_inicio"] = $fecha_inicio;
   $reg["fecha_fin"] = $fecha_fin;
   
   $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
   $rs1 = $db->AutoExecute("promociones", $reg, "UPDATE", "id_promocion='".$id_promocion."'");
   header("Location: promociones.php");
   exit();
} else {
   echo "<script type='text/javascript'>
   window.location.href = 'promociones.php';
</script>";
}
?> 