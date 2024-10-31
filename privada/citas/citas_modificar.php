<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");


//$db->debug=true;
$id_cliente = $_POST["id_cliente"];
$id_cita = $_POST["id_cita"];
$id_empleado = $_POST["id_empleado"];
echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
         <script type='text/javascript' src='../js/expresiones_regulares.js'></script>
         <script type='text/javascript' src='js/validarcita'></script>
       </head>
       <body>
       <p> &nbsp;</p>
         <h1 class='h11'>MODIFICAR CITA</h1>";

$sql = $db->Prepare("SELECT *
                     FROM citas
                     WHERE id_cita = ?
                     AND estado = 'A'                        
                        ");
$rs = $db->GetAll($sql, array($id_cita));


$sql1 = $db->Prepare("SELECT CONCAT_WS(' ' ,apellido, nombre) as cliente, id_cliente
                     FROM clientes
                     WHERE id_cliente = ?
                     AND estado = 'A'                        
                        ");
$rs1 = $db->GetAll($sql1, array($id_cliente));

$sql2 = $db->Prepare("SELECT CONCAT_WS(' ' ,apellido, nombre) as cliente, id_cliente
                     FROM clientes
                     WHERE id_cliente <> ?
                     AND estado = 'A'                        
                        ");
$rs2 = $db->GetAll($sql2, array($id_cliente));



$sql3 = $db->Prepare("SELECT CONCAT_WS(' ' ,ap,am, nombre) as empleado, id_empleado
                     FROM empleados
                     WHERE id_empleado = ?
                     AND estado = 'A'                        
                        ");
$rs3 = $db->GetAll($sql3, array($id_empleado));

$sql4 = $db->Prepare("SELECT CONCAT_WS(' ' ,ap,am, nombre) as empleado, id_empleado
                     FROM empleados
                     WHERE id_empleado <> ?
                     AND estado = 'A'                        
                        ");
$rs4 = $db->GetAll($sql4, array($id_empleado));
 /*  if ($rs) {*/
        echo"<form action='citas_modificar1.php' method='post' name='formu'>";
        echo"<center class='listita'>
                <table class='listado'>
                  <tr>
                    <th>(*)Cliente</th>
                    <td>
                      <select name='id_cliente'>";
                        foreach ($rs1 as $k => $fila) {
                        echo"<option value='".$fila['id_cliente']."'>".$fila['cliente']."</option>";    
                        }  
                        foreach ($rs2 as $k => $fila) {
                        echo"<option value='".$fila['id_cliente']."'>".$fila['cliente']."</option>";    
                        }  

                echo"</select>
                    </td>
                  </tr>
                  <tr>
                    <th>(*)Empleado</th>
                    <td>
                      <select name='id_empleado'>";
                        foreach ($rs3 as $k => $fila) {
                        echo"<option value='".$fila['id_empleado']."'>".$fila['empleado']."</option>";    
                        }  
                        foreach ($rs4 as $k => $fila) {
                        echo"<option value='".$fila['id_empleado']."'>".$fila['empleado']."</option>";    
                        }  

                echo"</select>
                    </td>
                  </tr>
                  ";
                foreach ($rs as $k => $fila) {
             echo"<tr>
                    <th><b>(*)Fecha</b></th>
                    <td><input type='date' name='fecha' size='10' value='".$fila["fecha"]."'></td>
                  </tr>
                  <tr>
                    <th><b>(*)Hora</b></th>
                    <td><input type='time' name='hora' size='10' value='".$fila["hora"]."'></td>
                  </tr>
                                  
                  <tr>
                    <td align='center' colspan='2'>  
                      <input type='button' value='ACEPTAR' onclick='validarcita()'; >
                      <a href='citas.php'>
                  <input type='button' value='CANCELAR'></input></a>
                    </td>
                      <input type='hidden' name='id_cita' value='".$fila["id_cita"]."'>
                    </td>
                  </tr>";
                }
                echo"</table>
                (*)Datos Obligatorios
                </center>";
          echo"</form>" ;     
    /*}*/

echo "</body>
      </html> ";

 ?>