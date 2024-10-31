<?php
session_start();

require_once("../../conexion.php");

$nombres1 = $_POST["nombres1"];
$apellidos1 = $_POST["apellidos1"];
$ci1 = $_POST["ci1"];
$profesion1 = $_POST["profesion1"];
$telefono1 = $_POST["telefono1"];
$direccion1 = $_POST["direccion1"];

$reg = array();
$reg["nombres"] = $nombres1;
$reg["apellidos"] = $apellidos1;
$reg["ci"] = $ci1;
$reg["profesion"] = $profesion1;
$reg["direccion"] = $direccion1;
$reg["telefono"] = $telefono1;

$reg["fecha_insercion"] = date("Y-m-d H:i:s");
$reg["estado"] = 'A';
$reg["usuario"] = $_SESSION["sesion_id_usuario"]; 
$rs1 = $db->AutoExecute("terapeutas", $reg, "INSERT");
?>
