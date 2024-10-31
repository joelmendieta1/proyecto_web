<?php
session_start();

require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");

$id = $_POST["id"];

//$db->debug=true;
$sql3 = $db->Prepare("SELECT *
                      FROM categorias
                      WHERE id = ?
                     ");
$rs3 = $db->GetAll($sql3, array($id));

echo"<center>
      <table class='table-bordered' style=' width:50%;border: 1px solid black; text-align:center'>
        <tr>
          <th colspan='4'>Datos De La Catregoria</th>
        </tr>";

foreach ($rs3 as $k => $fila) {
    echo"<tr>
            <td align='center'>".$fila["Categoria"]."</td>
         </tr>";
}
echo"</table>
    </center>";

// CON ESTA CONSULTA VISUALIZO LOS USUARIOS CREADOS DE LA PERSONA
$sql4 = $db->Prepare("SELECT *
                      FROM libros
                      WHERE Categoria_id = ?
                     ");
$rs4 = $db->GetAll($sql4, array($id));

echo"<center>
      <table class='table-bordered' style='border: 1px solid black;width:50%; text-align:center' >
        <thead>
        <th colspan='4'>Datos de Libros</th>
        <tr>
          <th>Codigo</th>
          <th>Titulo</th>
          <th>Nro Paginas</th>
          <th>Editorial</th>
        </tr>
        </thead>
      ";
if ($rs4){
    foreach ($rs4 as $k => $fila) {
        echo"<tr>
                <td align='center'>".$fila["codigo"]."</td>
                <td align='center'>".$fila["titulo"]."</td>
                <td align='center'>".$fila["nro_paginas"]."</td>
                <td align='center'>".$fila["editorial"]."</td>
             </tr>";
    }
} else {
    echo"<tr>
            <td align='center'>NO TIENE LIBROS</td>
         </tr>";
}

echo"</table>
    </center>";
?>
