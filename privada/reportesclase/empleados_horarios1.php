<?php
session_start();
require_once("../../conexion.php");
//$db->debug=true;
echo"<html> 
       <head>
       <script type='text/javascript'>
       var ventanacalendario=false
       function imprimir(){
          if(confirm('desea imprimir ?')){
            window.print();
          }
        }
       </script>
       </head>
       <body style='cursor:pointer;cursor:hand' onclick=imprimir();'>";

$sql = $db->Prepare("SELECT * FROM vista_empleados_horarios");
$rs = $db->GetAll($sql);

$sql1 = $db->Prepare("SELECT * FROM vista_peluqueria");
$rs1 = $db->GetAll($sql1);
        $nombre = $rs1[0]["nombre"];
     	$logo = $rs1[0]["logo"];
        $fecha=date("Y-m-d H:i:s");

if($rs){
    echo"
    <table width='100%'border='0'>
    <tr>
    <td><img src='../peluqueria/logos/{$logo}' width='70%'></td>
    <td align='center' width='80%'><h1 style='margin-left:-250px;'>REPORTE DE EMPLEADOS Y HORARIOS</h1></td>
    </tr>
    </table>
    ";
    echo "
    <center>
    <table border='1' cellspacing='0'>
    <tr>
            <th>Nro</th>
            <th>EMPLEADO</th>
            <th>HORARIO</th>
        </tr>";
        $b = 1;
    foreach ($rs as $k => $fila) {
        echo "<tr>
            <td align='center'>" . $b . "</td>
            <td>" . $fila['EMPLEADO'] . "</td>
            <td>" . $fila['TURNO'] . "</td>
                     </tr>";
        $b = $b + 1;
    }
        echo "</table>
        <b>fecha:</b>".$fecha."
        </center>";
    }
    echo "</body>
            </html>";
?>