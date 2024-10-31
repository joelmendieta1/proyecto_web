<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;
echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
$id_cita = $_POST["id_cita"];
$id_cliente = $_POST["id_cliente"];
$id_empleado = $_POST["id_empleado"];
$fecha = $_POST["fecha"];
$hora = $_POST["hora"];
$hash=password_hash($hora, PASSWORD_DEFAULT);

if(($id_cliente!="") and ($id_empleado!="") and  ($fecha!="") and ($hora!="")){
   $reg = array();
   $reg["id_cliente"] = $id_cliente;
   $reg["id_empleado"] = $id_empleado;
   $reg["fecha"] = $fecha;
   $reg["hora"] = $hora;   
   $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
   $rs1 = $db->AutoExecute("citas", $reg, "UPDATE", "id_cita='".$id_cita."'");
   header("Location: citas.php");
   exit();
} else {
   require_once("../../libreria_menu.php");
           echo"<div class='mensaje'>";
        $mensage = "NO SE MODIFICARON LOS DATOS DEL USUARIO2";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='citas.php'>s
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   }
echo "</body>
      </html> ";
?> 