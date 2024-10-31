<?php
session_start();
require_once("../../conexion.php");

$id_categoria_servicio = $_POST["id_categoria_servicio"];
$nombre = $_POST["nombre"];

if(($nombre!="")){
   $reg = array();
   $reg["id_peluqueria"] = 1;
   $reg["nombre"] = $nombre;
   $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
   $rs1 = $db->AutoExecute("categorias_servicios", $reg, "UPDATE", "id_categoria_servicio='".$id_categoria_servicio."'");
   header("Location: categorias_servicios.php");
   exit();
} else {
   echo "<script type='text/javascript'>
   window.location.href = 'categorias_servicios.php';
</script>";
}
?> 