<?php
session_start();
require_once("../../conexion.php");


//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
       
$id_persona = $_POST["id_persona"];
$ap = $_POST["ap"];
$am = $_POST["am"];
$nombres = $_POST["nombres"];
$ci = $_POST["ci"];
$direccion = $_POST["direccion"];
$telefono = $_POST["telefono"];
//$genero1 = isset($_POST["genero"]); 

if(($nombres!="") and  ($ci!="") ){
   $reg = array();
   $reg["id_tienda"] = 1;
   $reg["ap"] = $ap;
   $reg["am"] = $am;
   $reg["nombres"] = $nombres;
   $reg["ci"] = $ci;
   $reg["direccion"] = $direccion;
   $reg["telefono"] = $telefono;
   //$reg["genero"] = $_POST["genero"];
   
   $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
   $rs1 = $db->AutoExecute("personas", $reg, "UPDATE", "id_persona='".$id_persona."'");
   header("Location: personas.php");
   exit();
} else {
   require_once("../../libreria_menu.php");
           echo"<div class='mensaje'>";
        $mensage = "NO SE MODIFICARON LOS DATOS DE LA PERSONA";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='personas.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   }

echo "</body>
      </html> ";
?> 