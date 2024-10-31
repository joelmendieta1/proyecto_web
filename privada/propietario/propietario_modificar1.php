<?php
session_start();
require_once("../../conexion.php");


       
$id_propietario = $_POST["id_propietario"];
$apellido = $_POST["apellido"];
$nombre = $_POST["nombre"];
$telefono = $_POST["telefono"];

if(($nombre!="") and  ($apellido!="") ){
   $reg = array();
   $reg["id_peluqueria"] = 1;
   $reg["apellido"] = $apellido;
   $reg["nombre"] = $nombre;
   $reg["telefono"] = $telefono;
   
   $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
   $rs1 = $db->AutoExecute("propietario", $reg, "UPDATE", "id_propietario='".$id_propietario."'");
   header("Location: propietario.php");
   exit();
} else {
   echo "<script type='text/javascript'>
   window.location.href = 'propietario.php';
</script>";
}
?> 