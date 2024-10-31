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

$ap = $_POST["ap"];
$am = $_POST["am"];
$nombres = $_POST["nombres"];
$ci = $_POST["ci"];
$direccion = $_POST["direccion"];
$telefono = $_POST["telefono"];

if(($nombres!="") and  ($ci!="") ){
   $reg = array();
   $reg["id_peluqueria"] = 1;
   $reg["ap"] = $ap;
   $reg["am"] = $am;
   $reg["nombres"] = $nombres;
   $reg["ci"] = $ci;
   $reg["direccion"] = $direccion;
   $reg["telefono"] = $telefono;

   $reg["fecha_insercion"] = date("Y-m-d H:i:s");
   $reg["estado"] = 'A';
   $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
   $rs1 = $db->AutoExecute("personas", $reg, "INSERT"); 
   header("Location:personas.php");
   exit();
} else {
   echo "<script type='text/javascript'>
   window.location.href = 'personas.php';
</script>";
   }


?> 