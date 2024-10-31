<?php
session_start();
require_once("../../conexion.php");

$id_empleado = $_POST["id_empleado"];
$ap = $_POST["ap"];
$am = $_POST["am"];
$nombre = $_POST["nombre"];
$ci = $_POST["ci"];
$telefono = $_POST["telefono"];
$fecha_inicio = $_POST["fecha_inicio"];
$fecha_fin = $_POST["fecha_fin"];
//$genero1 = isset($_POST["genero"]); 

if(($nombre!="") and  ($ci!="") and  ($telefono!="")){
   $reg = array();
   $reg["id_peluqueria"] = 1;
   $reg["ap"] = $ap;
   $reg["am"] = $am;
   $reg["nombre"] = $nombre;
   $reg["ci"] = $ci;
   $reg["telefono"] = $telefono;
   $reg["fecha_inicio"] = $fecha_inicio;
   $reg["fecha_fin"] = $fecha_fin;
   
   $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
   $rs1 = $db->AutoExecute("empleados", $reg, "UPDATE", "id_empleado='".$id_empleado."'");
   header("Location: empleados.php");
   exit();
} else {
   echo "<script type='text/javascript'>
   window.location.href = 'personas.php';
</script>";
}

?> 