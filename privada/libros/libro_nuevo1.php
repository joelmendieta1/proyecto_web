<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;
$id = $_POST["id"];
$codigo = $_POST["codigo"];
$titulo = $_POST["titulo"];
$nro_paginas = $_POST["nro_paginas"];
$editorial = $_POST["editorial"];

if(($id!="") and  ($codigo!="") ){
   $reg = array();
   $reg["Categoria_id"] = $id;
   $reg["codigo"] = $codigo;
   $reg["titulo"] = $titulo;
   $reg["nro_paginas"] = $nro_paginas;
   $reg["editorial"] = $editorial;

   $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
   $rs1 = $db->AutoExecute("libros", $reg, "INSERT"); 
   header("Location:libros.php");
   exit();
} else {
   echo "<script type='text/javascript'>
   alert('Nose puedo insertar datos selecione todos los datos');
   window.location.href = 'libros.php';
</script>";
   }


?> 