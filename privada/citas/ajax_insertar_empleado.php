<?php
session_start();

require_once("../../conexion.php");

// Recibir los datos del formulario
$nombre1 = $_POST["nombre1"];
$ap1 = $_POST["ap1"];
$am1 = $_POST["am1"];
$ci1 = $_POST["ci1"];
$telefono2 = $_POST["telefono2"];
$fecha_inicio1 = $_POST["fecha_inicio1"];
$fecha_fin1 = $_POST["fecha_fin1"];

// Crear un arreglo con los datos a insertar
$reg = array();
$reg["id_peluqueria"] = 1;
$reg["nombre"] = $nombre1;
$reg["ap"] = $ap1;
$reg["am"] = $am1;
$reg["ci"] = $ci1;
$reg["telefono"] = $telefono2;
$reg["fecha_inicio"] = $fecha_inicio1;
$reg["fecha_fin"] = $fecha_fin1;
$reg["fecha_insercion"] = date("Y-m-d H:i:s");
$reg["estado"] = 'A';
$reg["usuario"] = $_SESSION["sesion_id_usuario"]; 

// Insertar los datos en la tabla "clientes"
$rs1 = $db->AutoExecute("empleados", $reg, "INSERT");
?>
