<?php
session_start();
require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");

// Recibir los datos del formulario
$Categoria = $_POST["Categoria"];

// Establecer conexión y consultar a la base de datos si hay datos proporcionados
if ($Categoria ) {
    $sql3 = $db->Prepare("SELECT *
                          FROM categorias
                          WHERE Categoria LIKE ?
                         ");
    $rs3 = $db->GetAll($sql3, array($Categoria."%"));
    
    // Incluir archivos CSS y scripts
    echo "<html>
            <body>
            <h4>Resultado de la búsqueda</h4>";
    if ($rs3) {
        // Generar la tabla con resultados
        echo "<center>
              <table class='table-bordered' style='border: 1px solid black;width:50%; text-align:center'>
                <tr>
                  <th>NOMBRE</th><th>Seleccionar</th>
                </tr>";
        foreach ($rs3 as $k => $fila) {
            $str = $fila["Categoria"];
            echo "<tr>
                    <td align='center'>".resaltar($Categoria, $str)."</td>
                    <td align='center'>
                      <input type='radio' name='opcion' value='' onClick='buscar_categoria(".$fila["id"].")'>
                    </td>
                  </tr>";
        }
        echo "</table>
        </center>";
    } else {
        // Mostrar formulario de adición de persona si no hay resultados
        echo "<center><b> LA CATEGORIA NO EXISTE!!</b><br>";
        echo "<form name='formu'>
                    <div >
                    <label>(*)Anañadir Categoria</label><br>
                        <input type='text' name='Categoria1' id='id' size='10'>
                    </div>
                    <br>
                    <div >
                    <input type='button' value='ACEPTAR' onclick='insertar_categoria();'><br>
                    <p>(*)datos obligatorios</p>
                </div>
              </form>
              </center>";
    }
    echo "</body></html>";
}
?>
