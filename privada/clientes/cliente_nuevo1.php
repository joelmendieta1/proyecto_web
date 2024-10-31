<?php
session_start();
require_once("../../conexion.php");

$db->debug = true;
$tipo = $_POST["tipo"];
$apellido = $_POST["apellido"];
$nombre = $_POST["nombre"];
$telefono = $_POST["telefono"];
$genero = $_POST["genero"];
if (($nombre != "") and  ($apellido != "" and  $telefono != "" and  $genero != "")
) {
   $reg = array();
   $reg["id_peluqueria"] = 1;
   $reg["id_tipo_cliente"] = $tipo;
   $reg["apellido"] = $apellido;
   $reg["telefono"] = $telefono;
   $reg["nombre"] = $nombre;
   $reg["genero"] = $genero;
   $reg["fecha_insercion"] = date("Y-m-d H:i:s");
   $reg["estado"] = 'A';
   $reg["usuario"] = $_SESSION["sesion_id_usuario"];
   $rs1 = $db->AutoExecute("clientes", $reg, "INSERT");
   header("Location: clientes.php");
   exit();
} else {
   echo "<script type='text/javascript'>
   alert('Nose puedo insertar datos selecione todos los datos');
   window.location.href = 'clientes.php';
</script>";
}
