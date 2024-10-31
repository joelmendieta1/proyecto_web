<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");

$id_peluqueria = 1;

echo "<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
         <script type='text/javascript' src='../js/expresiones_regulares.js'></script>
         <script type='text/javascript' src='js/validarpeluqueria'></script>
       </head>
       <body>
       <p> &nbsp;</p>";

echo "<h1 class='h11'>MODIFICAR PELUQUERIA</h1>";

$sql = $db->Prepare("SELECT * FROM peluqueria WHERE id_peluqueria = ? AND estado <> 'X'");
$rs = $db->GetAll($sql, array($id_peluqueria));

if ($rs) {
    foreach ($rs as $k => $fila) {
        echo "<form action='peluqueria_modificar1.php' method='post' enctype='multipart/form-data' name='formu'>";
        echo "<center class='listita'>
                  <table class='listado'>
                    <tr>
                      <th><b>(*)NOMBRE</b></th>
                      <td><input type='text' name='nombre' size='20' value='" . $fila["nombre"] . "'></td>
                    </tr>
                    <tr>
                      <th><b>(*)TELEFONO</b></th>
                      <td><input type='text' name='telefono' size='20' onkeyup='this.value=this.value.toUpperCase()' value='" . $fila["telefono"] . "'></td>
                    </tr>
                    <tr>
                      <th><b>(*)DIRECCION</b></th>
                      <td><input type='text' name='direccion' size='20' onkeyup='this.value=this.value.toUpperCase()' value='" . $fila["direccion"] . "'>
                      </td>                    
                    </tr>
                    <tr>
                      <th><b>LOGO</b></th><td><input type='file' name='logo' size='20' accept='image/*'><br>" . $fila["logo"] . "
                      <input type='hidden' name='logo' value='" . $fila["logo"] . "'>
                      </td>
                    </tr>
                    <tr>
                      <td align='center' colspan='2'>  
                        <input type='submit' value='ACEPTAR' >
                      </td>
                        <input type='hidden' name='id_peluqueria' value='" . $fila["id_peluqueria"] . "'>
                      </td>
                    </tr>
                  </table>
                  (*)Datos Obligatorios
                  </center>";
        echo "</form>";
    }
} else {
    echo "<h2 class='rojo'>NO EXISTE ESTA PELUQUERIA</h2>";
}
echo "</body>
      </html> ";