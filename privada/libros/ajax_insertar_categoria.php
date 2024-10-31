<?php
session_start();

require_once("../../conexion.php");

$Categoria1 = $_POST["Categoria1"];


$reg = array();
$reg["Categoria"] = $Categoria1;
$reg["usuario"] = $_SESSION["sesion_id_usuario"];
$rs1 = $db->AutoExecute("categorias", $reg, "INSERT");
?>
