<?php
ob_start();
session_start();
require_once("../../conexion.php");

//$db->debug=true;

echo"<html>
           <head>

        </head>

        <body>";

        $sql = $db->Prepare('SELECT * FROM vista_empleados_horarios');
        $rs = $db->GetAll($sql);

        $sql1 = $db->Prepare('SELECT * FROM vista_peluqueria');
        $rs1 = $db->GetAll($sql1);

        $nombre = $rs1[0]["nombre"];
        $logo = $rs1[0]["logo"];
        $fecha= date("Y-m-d H:i:s");

        if ($rs) { 

           echo"<table border='0' width='100%' >

                <tr>

                    <td><img src='http://".$_SERVER['HTTP_HOST']."/DISEÑO WEB/SEGUNDO BIMESTRE/prac5_29-05_MENDIETA/SISTEMA WEB/privada/peluqueria/logos/{$logo}' width='100%' >
                    </td>

                    <td align='center' width='80%'><h1>REPORTE DE EMPLEADOS Y HORARIOS</h1></td>
                    </tr>
                   </table>";

            echo"
            <center>
            <table border='1' cellspacing='0' width='100%' >
            <tr>
                <th>Nro</th><th>EMPLEADO</th><th>HORARIO</th>
            </tr>";
            $b=1;
            foreach ($rs as $k => $fila) {
            echo"<tr>
                    <td align='center'>".$b."</td>
                    <td>".$fila[ 'EMPLEADO' ]."</td>
                    <td><i>".$fila[ 'TURNO']."</i></td>
                </tr>";
            $b=$b+1;
        }  

        echo"</table><br>
        <b>Fecha :</b>".$fecha."</center>";

    }
echo "</body>
</html> ";

$html=ob_get_clean();
//echo $html;

require_once("../dompdf/autoload.inc.php");
use Dompdf\dompdf;
$dompdf =new Dompdf();

$options=$dompdf->getOptions();
$options->set(array('isRemoteEnabled' =>true));
$dompdf->setOptions($options);

$dompdf->loadHtml($html);

$dompdf->setPaper('letter');

$dompdf->render();

$dompdf->stream("archivo.pdf",array("Attachment" => false));