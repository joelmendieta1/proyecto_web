<?php
session_start();
require_once("../../conexion.php");

$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
       


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
   
} else {
           echo"<div class='mensaje'>";
        $mensage = "NO SE INSERTARON LOS DATOS DEL USUARIO";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='usuario_nuevo.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   }
   


   header("Location: usuarios.php");
   exit();
echo "</body>
      </html> ";
?> 