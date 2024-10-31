<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");
//$db->debug=true;

$id_persona = $_POST["id_persona"];


echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
         <script type='text/javascript' src='../js/expresiones_regulares.js'></script>
         <script type='text/javascript' src='js/validarpersona'></script>
       </head>
       <body>
       <p> &nbsp;</p>";
       
         echo"<h1 class='h11'>MODIFICAR PERSONA</h1>";

$sql = $db->Prepare("SELECT *
                     FROM personas
                     WHERE id_persona = ?
                     AND estado <> 'X'                        
                        ");
$rs = $db->GetAll($sql,array($id_persona));
 /*  if ($rs) {*/
  foreach ($rs as $k => $fila) {  
        echo"<form action='persona_modificar1.php' method='post' name='formu'>";
        echo"<center class='listita'>
                <table class='listado'>
                  <tr>
                    <th><b>(*)CI</b></th>
                    <td><input type='text' name='ci' size='10' value='".$fila["ci"]."'></td>
                  </tr>
                  <tr>
                    <th><b>Paterno</b></th>
                    <td><input type='text' name='ap' size='10' onkeyup='this.value=this.value.toUpperCase()' value='".$fila["ap"]."'></td>
                  </tr>
                  <tr>
                    <th><b>Materno</b></th>
                    <td><input type='text' name='am' size='10' onkeyup='this.value=this.value.toUpperCase()' value='".$fila["am"]."'>
                    </td>                    
                  </tr>
                  <tr>
                    <th><b>(*)Nombres</b></th><td><input type='text' name='nombres' size='10' onkeyup='this.value=this.value.toUpperCase()' value='".$fila["nombres"]."'>
                    </td>
                  </tr>
                  <tr>
                    <th><b>Dirección</b></th>
                    <td><input type='text' name='direccion' size='10' onkeyup='this.value=this.value.toUpperCase()' value='".$fila["direccion"]."'>
                    </td>
                  </tr>
                  <tr>
                    <th><b>Telefono</b></th><td><input type='text' name='telefono' size='10' value='".$fila["telefono"]."'></td>
                  </tr>

                  ";

                  /*<tr>
                    <th><b>(*)Genero</b></th>";
                    if ($fila["genero"] == 'F')   
                    echo"<td><input type='radio' name='genero' size='10' value='F' checked>Femenino
                      <input type='radio' name='genero' size='10' value='M'>Masculino<br>
                    </td>";
                    else
                     echo"<td><input type='radio' name='genero' size='10' value='F' >Femenino
                      <input type='radio' name='genero' size='10' value='M' checked>Masculino<br>
                    </td>"; 
                  echo"</tr>*/
                  
                  echo"

                  <tr>
                    <td align='center' colspan='2'>  
                      <input type='button' value='ACEPTAR' onclick='ValidarPersona()'; >
                      <a href='personas.php'>
                  <input type='button' value='CANCELAR'></input></a>
                    </td>
                      <input type='hidden' name='id_persona' value='".$fila["id_persona"]."'>
                    </td>
                  </tr>
                </table>
                (*)Datos Obligatorios
                </center>";
          echo"</form>" ;     
    /*}*/
}
echo "</body>
      </html> ";

 ?>