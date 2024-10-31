<?php
session_start();
require_once("../../conexion.php");

// Depuración habilitada para ver consultas SQL
//$db->debug=true;

$fecha1 = $_REQUEST["fecha1"];
$fecha2 = $_REQUEST["fecha2"];

// No es necesario usar DATE() en PHP para las fechas
$fecha11 = $fecha1;
$fecha22 = $fecha2;

$sql = $db->Prepare("
   SELECT CONCAT_WS(' ', cli.nombre, cli.apellido) AS cliente,
          CONCAT_WS(' ', emp.nombre, emp.ap, emp.am) AS empleado,
          cat.nombre AS servicio,
          dts.precio,
          dts.descipcion AS descripcion, -- Cambia 'descipcion' o ajusta la tabla
          cit.fecha,
          cit.hora
   FROM citas cit
   INNER JOIN detalles_servicios dts ON dts.id_cita = cit.id_cita
   INNER JOIN categorias_servicios cat ON cat.id_categoria_servicio = dts.id_categoria_servicio
   INNER JOIN clientes cli ON cli.id_cliente = cit.id_cliente
   INNER JOIN empleados emp ON emp.id_empleado = cit.id_empleado
   WHERE cit.fecha BETWEEN ? AND ?
   AND cit.estado = 'A'
   AND dts.estado = 'A'
   AND cli.estado = 'A'
   AND emp.estado = 'A';
");

// Pasa las fechas en formato correcto
$rs = $db->GetAll($sql, array($fecha1, $fecha2));


$sql1 = $db->Prepare("SELECT * FROM vista_peluqueria");
$rs1 = $db->GetAll($sql1);
$nombre = $rs1[0]["nombre"];
$logo = $rs1[0]["logo"];

// Imprimir el reporte en HTML
echo "<html>
       <head>
       <script type='text/javascript'>
           var ventanaCalendario=false;
           function imprimir() {
               if (confirm('Desea Imprimir ?')) {
                   window.print();
               }
           }
       </script>
       </head>
<body style='cursor:pointer;cursor:hand' onClick='imprimir();'>";

if ($rs) {
  // Mostrar cabecera del reporte
  echo "<table width='100%' border='0'>
            <tr>
                <td><img src='http://" . $_SERVER['HTTP_HOST'] . "/DISEÑO WEB/SEGUNDO BIMESTRE/prac5_29-05_MENDIETA/SISTEMA WEB/privada/peluqueria/logos/{$logo}' width='70%'></td>
                <td align='center' width='80%'><h1>REPORTE DE HISTORIAL DE FECHA A FECHA DE CLIENTES, EMPLEADOS, SERVICIOS Y CITAS</h1></td>
            </tr>
        </table>";

  // Mostrar tabla con los datos
  echo "<center>
            <table border='1' cellspacing='0'>
                <tr>
                    <th>Nro</th>
                    <th>CLIENTE</th>
                    <th>EMPLEADO</th>
                    <th>SERVICIO</th>
                    <th>PRECIO</th>
                    <th>DESCRIPCIÓN</th>
                    <th>FECHA</th>
                    <th>HORA</th>
                </tr>";
  
  // Contador de filas
  $b = 1;
  foreach ($rs as $fila) {
    echo "<tr>
            <td align='center'>" . $b . "</td>
            <td>" . $fila['cliente'] . "</td>
            <td>" . $fila['empleado'] . "</td>
            <td>" . $fila['servicio'] . "</td>
            <td>" . $fila['precio'] . "</td>
            <td>" . $fila['descripcion'] . "</td> <!-- Cambiado 'descipcion' a 'descripcion' -->
            <td>" . $fila['fecha'] . "</td>
            <td>" . $fila['hora'] . "</td>
          </tr>";
    $b++;
  }

  echo "</table><br>
        <b>DEL :</b> " . $fecha11 . " <b>AL :</b> " . $fecha22 . "
        </center>";
} else {
  echo "<p>No se encontraron registros en el rango de fechas proporcionado.</p>";
}

echo "</body></html>";
