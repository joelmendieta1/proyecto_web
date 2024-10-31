<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;
$id_terapeuta = $_POST["id_terapeuta"];
$cargos = $_POST["cargos"];
$fecha_inicio = $_POST["fecha_inicio"];
$fecha_final = $_POST["fecha_final"];

if(($id_terapeuta!="") and  ($cargos!="") and  ($fecha_inicio!="")){
   $reg = array();
   $reg["id_terapeuta"] = $id_terapeuta;
   $reg["cargos"] = $cargos;
   $reg["fecha_inicio"] = $fecha_inicio;
   $reg["fecha_final"] = $fecha_final;

   $reg["fec_insercion"] = date("Y-m-d H:i:s");
   $reg["estado"] = 'A';
   $reg["usuario"] = $_SESSION["sesion_id_usuario"];    
   $rs1 = $db->AutoExecute("directorio", $reg, "INSERT"); 
   header("Location:directorio.php");
   exit();
} else {
   echo "<script type='text/javascript'>
   alert('Nose puedo insertar datos selecione todos los datos');
   window.location.href = 'directorio.php';
</script>";
   }


?> 