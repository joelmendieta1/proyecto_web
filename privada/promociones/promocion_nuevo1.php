<?php
session_start();
require_once("../../conexion.php");
if (!isset($_SESSION["sesion_id_rol"])) {
   // Si no ha iniciado sesión, redirigir al login
   header("Location: index.php");
   exit();
}
?>
<?php

$descuento = $_POST["descuento"];
$descripcion = $_POST["descripcion"];
$fecha_inicio = $_POST["fecha_inicio"];
$fecha_fin = $_POST["fecha_fin"];

if(($descripcion!="") and  ($descuento!="") ){
   $reg = array();
   $reg["id_peluqueria"] = 1;
   $reg["descuento"] = $descuento;
   $reg["descripcion"] = $descripcion;
   $reg["fecha_inicio"] = $fecha_inicio;
   $reg["fecha_fin"] = $fecha_fin;

   $reg["fecha_insercion"] = date("Y-m-d H:i:s");
   $reg["estado"] = 'A';
   $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
   $rs1 = $db->AutoExecute("promociones", $reg, "INSERT"); 
   header("Location:promociones.php");
   exit();
} else {
   echo "<script type='text/javascript'>
   window.location.href = 'promociones.php';
</script>";
   }


?> 