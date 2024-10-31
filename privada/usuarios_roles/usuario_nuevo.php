<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");
//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
         <script type='text/javascript' src='../js/expresiones_regulares.js'></script>
         <script type='text/javascript' src='js/validarusuario'></script>
       </head>
       <body>
       <p> &nbsp;</p>
         <h1 class='h11'>INSERTAR USUARIO</h1>";

$sql = $db->Prepare("SELECT CONCAT_WS(' ' ,ap, am, nombres) as persona, id_persona
                     FROM personas
                     WHERE estado = 'A'                        
                        ");
$rs = $db->GetAll($sql);
 /*  if ($rs) {*/
        echo"<form action='usuario_nuevo1.php' method='post' name='formu'>";
        echo"<center class='listita'>
                <table class='listado'>
                  <tr>
                    <th>(*)Persona</th>
                    <td>
                      <select name='id_persona'>
                        <option value=''>--Seleccione--</option>";
                        foreach ($rs as $k => $fila) {
                        echo"<option value='".$fila['id_persona']."'>".$fila['persona']."</option>";    
                        }  

                echo"</select>
                    </td>
                  </tr>";
             echo"<tr>
                    <th><b>(*)Nombre de usuario</b></th>
                    <td><input type='text' name='usuario' size='10'></td>
                  </tr>
                  <tr>
                    <th><b>(*)Clave</b></th>
                    <td><input type='password' name='clave' size='10'></td>
                  </tr>
                  
                  <tr>
                    <td align='center' colspan='2'>  
                      <input type='button' value='ACEPTAR' onclick='validar()'; >
                      <a href='usuarios.php'>
                  <input type='button' value='CANCELAR'></input></a>
                    </td>
                    </td>
                  </tr>
                </table>
                (*)Datos Obligatorios
                </center>";
          echo"</form>" ;     
    /*}*/

echo "</body>
      </html> ";

 ?>