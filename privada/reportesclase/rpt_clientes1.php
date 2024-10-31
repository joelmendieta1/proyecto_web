<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");
//$db->debug=true;

echo "
    <html>
    <head>
    <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
    <script type='text/javascript'>
    var ventanacalendario=false
    function imprimir(){
        ventanacalendario= window.open('clientes_citas1.php','caledario','width=600,height=550, top=100; scrollbars=yes,menubars=no,statusbar=NO,Status=NO,resizable=YES,location=NO')
    }
    </script>

    <script type='text/javascript'>
    var ventanacalendario=false
    function generrar_pdf(){
        ventanacalendario= window.open('clientes_citas1_pdf.php','caledario','width=600,height=550, top=100; scrollbars=yes,menubars=no,statusbar=NO,Status=NO,resizable=YES,location=NO')
    }
    </script>
    </head>
    <body>
    <p> &nbsp;</p>";

$sql = $db->Prepare("SELECT * FROM clientes_citas_horas");
$rs = $db->GetAll($sql);
if ($rs) {
    echo"<center class='listalista'>
    <h1>REPORTE DE CLIENTES CON HORARIOS RESERVADOS</h1>
    <table class='listado'>
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
    <h2>
    <input type='radio' name='seleccionar' onclick='javascript:imprimir()'>imprimir
    </h2>
    <h2>
    <input type='radio' name='seleccionar' onclick='javascript:generrar_pdf()'>generar pdf
    </h2>

    </center>";
}
echo "</body>
        </html>"
?>