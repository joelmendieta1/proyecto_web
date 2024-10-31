<?php
session_start();

require_once("../../conexion.php");

// Recibir los datos del formulario
$tipo1 = $_POST["tipo1"];
$nombre1 = $_POST["nombre1"];
$apellido1 = $_POST["apellido1"];
$telefono1 = $_POST["telefono1"];
$genero1 = $_POST["genero1"];

// Crear un arreglo con los datos a insertar
$reg = array();
$reg["id_peluqueria"] = 1;
$reg["id_tipo_cliente"] = $tipo1;
$reg["nombre"] = $nombre1;
$reg["apellido"] = $apellido1;
$reg["telefono"] = $telefono1;
$reg["genero"] = $genero1;
$reg["fecha_insercion"] = date("Y-m-d H:i:s");
$reg["estado"] = 'A';
$reg["usuario"] = $_SESSION["sesion_id_usuario"]; 

// Insertar los datos en la tabla "clientes"
$rs1 = $db->AutoExecute("clientes", $reg, "INSERT");
?>
