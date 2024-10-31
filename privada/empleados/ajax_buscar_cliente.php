<?php
session_start();
require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");

$apellido = $_POST["apellido"];
$nombre = $_POST["nombre"];
$telefono = $_POST["telefono"];
$genero = $_POST["genero"];
$fecha = $_POST["fecha"];

//$db->debug=true;
if ($apellido or $nombre or $telefono or $genero or $fecha){
    $sql3 = $db->Prepare("      SELECT  *
                                FROM    clientes
                                WHERE   apellido LIKE ?
                                AND     nombre LIKE ?
                                AND     telefono LIKE ?
                                AND     genero LIKE ?
                                AND     fecha_insercion LIKE ?
                                AND     estado <> 'X'
    ");
    $rs3 = $db->GetAll($sql3, array($apellido."%", $nombre."%", $telefono."%", $genero."%", $fecha."%"));
    if ($rs3) {
        echo"<center class='listalist'>
        <table class='listado'>
            <tr>
                <th>APELLIDO</th><th>NOMBRE</th><th>TELEFONO</th><th>GENERO</th><th>FECHA</th><th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
            </tr>";
        foreach ($rs3 as $k => $fila) {
            $str = $fila["apellido"];
            $str1 = $fila["nombre"];
            $str2 = $fila["telefono"];
            $str3 = $fila["genero"];
            $str4 = $fila["fecha_insercion"];

            echo"<tr>
    <td align='center'>".resaltar($apellido, $str)."</td>
    <td>".resaltar($nombre, $str1)."</td>
    <td>".resaltar($telefono, $str2)."</td>
    <td>".resaltar($genero, $str3)."</td>
    <td>".resaltar($fecha, $str4)."</td>
    <td align='center'>
        <form name='formModif".$fila["id_cliente"]."' method='post' action='persona_modificar.php'>
            <input type='hidden' name='id_cliente' value='".$fila['id_cliente']."'>
            <a href='javascript:document.formModif".$fila['id_cliente'].".submit();' title='Modificar Persona Sistema'>
                Modificar>>
            </a>
        </form>
    </td>
    <td align='center'>
        <form name='formElimi".$fila["id_cliente"]."' method='post' action='persona_eliminar.php'>
            <input type='hidden' name='id_cliente' value='".$fila["id_cliente"]."'>
            <a href='javascript:document.formElimi".$fila['id_cliente'].".submit();' title='Eliminar Persona Sistema' onclick='javascript:return(confirm(\"Desea realmente Eliminar a la persona ".$fila["nombre"]." ".$fila["apellido"]." ".$fila["telefono"]." ?\"))'; 
            location.href='persona_eliminar.php''>
                Eliminar>>
            </a>
        </form>
    </td>
</tr>";
        }
    echo"</table>
    </center>";
} else {
    echo"<center class='listalist'><b> LA PERSONA NO EXISTE!!</b></center><br>";
}
}
?>
