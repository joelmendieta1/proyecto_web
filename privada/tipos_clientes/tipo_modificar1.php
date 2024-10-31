<?php
session_start();
require_once("../../conexion.php");

$id_tipo_cliente = $_POST["id_tipo_cliente"];
$nombre = $_POST["nombre"];

if(($nombre!="")){
   $reg = array();
   $reg["id_peluqueria"] = 1;
   $reg["nombre"] = $nombre;
   $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
   $rs1 = $db->AutoExecute("tipos_clientes", $reg, "UPDATE", "id_tipo_cliente='".$id_tipo_cliente."'");
   header("Location: tipos_clientes.php");
   exit();
} else {
   echo "<script type='text/javascript'>
   window.location.href = 'tipos_clientes.php';
</script>";
}
?> 