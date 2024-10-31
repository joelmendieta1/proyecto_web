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

$id_persona = $_POST["id_persona"];
$usuario = $_POST["usuario"];
$clave = $_POST["clave"];
$hash=password_hash($clave, PASSWORD_DEFAULT);

if(($id_persona!="") and  ($usuario!="") and ($clave!="")){
   $reg = array();
   $reg["id_persona"] = $id_persona;
   $reg["usuario"] = $usuario;
   $reg["clave"] = $hash;
   $reg["fecha_insercion"] = date("Y-m-d H:i:s");
   $reg["estado"] = 'A';
   $reg["usuario1"] = $_SESSION["sesion_id_usuario"];   
   $rs1 = $db->AutoExecute("usuarios", $reg, "INSERT"); 
   header("Location: usuarios.php");
   exit();
   
} else {
   echo "<script type='text/javascript'>
   window.location.href = 'usuarios.php';
</script>";
   
   }
   
?> 