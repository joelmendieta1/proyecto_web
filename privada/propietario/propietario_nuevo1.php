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

//$db->debug=true;

$apellido = $_POST["apellido"];
$nombre = $_POST["nombre"];
$telefono = $_POST["telefono"];

if(($nombre!="") and  ($apellido!="") ){
   $reg = array();
   $reg["id_peluqueria"] = 1;
   $reg["apellido"] = $apellido;
   $reg["nombre"] = $nombre;
   $reg["telefono"] = $telefono;

   $reg["fecha_insercion"] = date("Y-m-d H:i:s");
   $reg["estado"] = 'A';
   $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
   $rs1 = $db->AutoExecute("propietario", $reg, "INSERT"); 
   header("Location:propietario.php");
   exit();
} else {
   echo "<script type='text/javascript'>
   window.location.href = 'propietario.php';
</script>";
   }


?> 