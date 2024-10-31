<?php
session_start();
require_once("../../conexion.php");


       
$id_persona = $_POST["id_persona"];
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
   
   $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
   $rs1 = $db->AutoExecute("personas", $reg, "UPDATE", "id_persona='".$id_persona."'");
   header("Location: personas.php");
   exit();
} else {
   echo "<script type='text/javascript'>
   window.location.href = 'personas.php';
</script>";
}
?> 