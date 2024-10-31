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

$sql = $db->Prepare("SELECT * FROM clientes_citas_horas");
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
    <td align='center' width='80%'><h1 style='margin-left:-250px;'>REPORTE DE CLIENTES CON HORARIOS RESERVADOS</h1></td>
    </tr>
    </table>
    ";
    echo "
    <center>
    <table border='1' cellspacing='0'>
    <tr>
            <th>Nro</th>
            <th>CLIENTE</th>
            <th>HORA DE ATENCION</th>
        </tr>";
        $b = 1;
    foreach ($rs as $k => $fila) {
        echo "<tr>
            <td align='center'>" . $b . "</td>
            <td>" . $fila['CLIENTE'] . "</td>
            <td>" . $fila['HORA DE ATENCION'] . "</td>
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