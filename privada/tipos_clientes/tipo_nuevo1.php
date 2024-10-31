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

$nombre = $_POST["nombre"];


if(($nombre!="")){
   $reg = array();
   $reg["id_peluqueria"] = 1;
   $reg["nombre"] = $nombre;

   $reg["fecha_insercion"] = date("Y-m-d H:i:s");
   $reg["estado"] = 'A';
   $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
   $rs1 = $db->AutoExecute("tipos_clientes", $reg, "INSERT"); 
   header("Location:tipos_clientes.php");
   exit();
} else {
   echo "<script type='text/javascript'>
   window.location.href = 'tipos_clientes.php';
</script>";
   }


?> 