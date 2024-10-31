<?php
session_start();
require_once("../../conexion.php");

$id_cliente = $_POST["id_cliente"];
$id_empleado = $_POST["id_empleado"];
$fecha = $_POST["fecha"];
$hora = $_POST["hora"];

if (($id_cliente != "") && ($id_empleado != "") && ($fecha != "") && ($hora != "")) {
    $reg = array();
    $reg["id_cliente"] = $id_cliente;
    $reg["id_empleado"] = $id_empleado;
    $reg["fecha"] = $fecha;
    $reg["hora"] = $hora;
    $reg["fecha_insercion"] = date("Y-m-d H:i:s");
    $reg["estado"] = 'A';
    $reg["usuario"] = $_SESSION["sesion_id_usuario"];

    $rs1 = $db->AutoExecute("citas", $reg, "INSERT"); 
    header("Location: citas.php");
    exit();
} else {
    echo "<script type='text/javascript'>
        alert('No se pueden insertar datos. Seleccione todos los campos.');
        window.location.href = 'citas_nuevo.php';
    </script>";
}
?>
