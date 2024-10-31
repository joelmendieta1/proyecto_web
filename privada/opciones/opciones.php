<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");
require_once("../../paginacion.inc.php");
//$db->debug=true;
$sql=$db->Prepare(" SELECT  * 
                    FROM    grupos
                    WHERE   estado='A'
                    ");
$rs=$db->GetAll($sql);
echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
         <script type='text/javascript' src='../../ajax.js'></script>
         <script type='text/javascript' src='js/buscar_opciones1.js'></script>
         <script type='text/javascript' src='js/buscar_opciones.js'></script>
       </head>
       <body>
       <p> &nbsp;</p>";


       echo"
<!-------INICIO BUSCADOR ------------>
    <center>
    <h1>LISTA DE OPCIONES</h1>
    <b><a href='opcion_nuevo.php'>Nueva Opcion>>></a></b>
        <form action='#'' method='post' name='formu'>
            <table border='1' class='listado'>
                <tr>
                    <th>
                        <b>Grupo</b><br />
                        <input type='text' name='grupo' value='' size='10' onKeyUp='buscar_opciones()'>
                    </th>
                    <th>
                        <b>Opcion</b><br />
                        <input type='text' name='opcion' value='' size='10' onKeyUp='buscar_opciones()'>
                    </th>
                </tr>
            </table>
        </form>
    </center>
<!--FIN BUSCADOR --------------->";
echo"
<!-------INICIO BUSCADOR ------------>
    <center>
        <form action='#'' method='post' name='formu2'>
            <table border='1' class='listado'>
                <tr>
                    <th>
                        <b>Grupo</b><br />
                        <select onchange='buscar_opciones1()' name='grupo1'>
                        <option value=''>--Seleccione--</option>";
                        foreach($rs as $k=>$fila){
                          echo"<option value='".$fila['grupo']."'>".$fila['grupo']."</option>";
                        }
                        echo"</select>
                    </th>
                    <th>
                        <b>Opcion</b><br />
                        <input type='text' name='opcion1' value='' size='10' onKeyUp='buscar_opciones1()'>
                    </th>
                </tr>
            </table>
        </form>
    </center>
<!--FIN BUSCADOR --------------->";
echo"<div id='opciones1'>";
contarRegistros($db,"opciones");

paginacion("opciones.php?");   
           $sql3 = $db->Prepare(" SELECT     gru.*,op.*
                                  FROM       grupos gru, opciones op
                                  WHERE      op.id_grupo=gru.id_grupo
                                  AND        gru.estado <> 'X' 
                                  AND        op.estado <> 'X'               
                                  ORDER BY   op.id_opcion ASC
                                  LIMIT      ? OFFSET ? 
                              ");
$rs = $db->GetAll($sql3,array($nElem,$regIni));
if ($rs) {
  echo"<center>
  
        <table class='listado'>
          <tr>                                   
            <th>N°</th><th>GRUPO</th><th>OPCION</th><th>CONTENIDO</th>
            <th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
          </tr>";
          $b=0;
                $total=$pag-1;
                $a=$nElem*$total;
                $b=$b+1+$a;
      foreach ($rs as $k => $fila) {                                       
          echo"<tr>
                  <td align='center'>".$b."</td>
                  <td>".$fila['grupo']."</td>                        
                  <td>".$fila['opcion']."</td>
                  <td>".$fila['contenido']."</td>
                  <td align='center'>
                    <form name='formModif".$fila["id_opcion"]."' method='post' action='opcion_modificar.php'>
                      <input type='hidden' name='id_opcion' value='".$fila['id_opcion']."'>
                      <input type='hidden' name='id_grupo' value='".$fila['id_grupo']."'>

                      <a href='javascript:document.formModif".$fila['id_opcion'].".submit();' title='Modificar Opcion Sistema'>
                        Modificar>>
                      </a>
                    </form>
                  </td>
                  <td align='center'>  
                    <form name='formElimi".$fila["id_opcion"]."' method='post' action='opcion_eliminar.php'>
                      <input type='hidden' name='id_opcion' value='".$fila["id_opcion"]."'>
                      <a href='javascript:document.formElimi".$fila['id_opcion'].".submit();' title='Eliminar Persona Sistema' onclick='javascript:return(confirm(\"Desea realmente Eliminar la opción ".$fila["opcion"]." ?\"))'; location.href='opcion_eliminar.php''> 
                        Eliminar>>
                      </a>
                    </form>                        
                  </td>
               </tr>";
               $b=$b+1;
      }
       echo"</table>";
        echo"</table>";
             paginacion1();
             echo"
    </center>";
}

echo"</div>";
echo "</body>
</html> ";

?>