<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");

$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
         <script type='text/javascript' src='../js/expresiones_regulares.js'></script>
         <script type='text/javascript' src='js/validarpersona'></script>
       </head>
       <body>
       <p> &nbsp;</p>";
              
       echo"<h1 class='h11'>INSERTAR PERSONA</h1>";

/*$sql = $db->Prepare("SELECT *
                     FROM _personas
                     WHERE _estado <> 'X'                        
                        ");
$rs = $db->GetAll($sql);*/
 /*  if ($rs) {*/
        echo"<form action='persona_nuevo1.php' method='post' name='formu'>";
        echo"<center class='listita'>
                <table class='listado'>
                  <tr>
                    <th><b>(*)CI</b></th>
                    <td><input type='text' name='ci' size='10'></td>
                  </tr>
                  <tr>
                    <th><b>Paterno</b></th>
                    <td><input type='text' name='ap' size='10' onkeyup='this.value=this.value.toUpperCase()'></td>
                  </tr>
                  <tr>
                    <th><b>Materno</b></th>
                    <td><input type='text' name='am' size='10' onkeyup='this.value=this.value.toUpperCase()'>
                    </td>                    
                  </tr>
                  <tr>
                    <th><b>(*)Nombres</b></th><td><input type='text' name='nombres' size='10' onkeyup='this.value=this.value.toUpperCase()'>
                    </td>
                  </tr>
                  <tr>
                    <th><b>Dirección</b></th>
                    <td><input type='text' name='direccion' size='10' onkeyup='this.value=this.value.toUpperCase()'>
                    </td>
                  </tr>
                  <tr>
                    <th><b>Telefono</b></th><td><input type='text' name='telefono' size='10'></td>
                  </tr>
                  ";
                  /*
                  <tr>
                    <th><b>(*)Genero</b></th>
                    <td><input type='radio' name='genero' size='10' value='F'>Femenino
                      <input type='radio' name='genero' size='10' value='M'>Masculino<br>
                    </td>
                  </tr>
                  <tr>
                  */
                  echo"
                  <tr>
                    <td align='center' colspan='2'>  
                      <input type='button' value='ACEPTAR' onclick='ValidarPersona()'; >
                      <a href='personas.php'>
                  <input type='button' value='CANCELAR'></input></a>
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