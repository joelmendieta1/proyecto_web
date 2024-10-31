<?php
session_start();
require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");
//$db->debug=true;
$cliente = strip_tags(stripslashes($_POST["cliente"]));
$empleado = strip_tags(stripslashes($_POST["empleado"]));
$fecha = strip_tags(stripslashes($_POST["fecha"]));
$hora = strip_tags(stripslashes($_POST["hora"]));

if ($cliente or $empleado or $fecha or $hora) {
    $sql3 = $db->Prepare(" SELECT CONCAT_WS(' ', cl.nombre, cl.apellido) AS cliente, CONCAT_WS(' ', e.nombre,e.ap) AS empleado, c.*
                                FROM citas c
                                INNER JOIN clientes as cl ON cl.id_cliente=c.id_cliente
                                INNER JOIN empleados as e ON e.id_empleado=c.id_empleado
                                WHERE   cl.nombre LIKE ?
                                AND     e.nombre LIKE ?
                                AND   c.fecha LIKE ?
                                AND     c.hora LIKE ?
                                AND c.estado <> 'X' 
                                AND cl.estado <> 'X'
                                AND e.estado <> 'X'              
                                                    ");
    $rs3 = $db->GetAll($sql3, array($cliente . "%", $empleado  . "%", $fecha . "%", $hora . "%"));
    if ($rs3) { ?>
        <div class="d-flex justify-content-center">
            <div class="table-responsive">
                <table class="table table-bordered border-dark">
                    <thead class="table-active" style="text-align: center;">
                        <tr>
                            <th scope="col">CLIENTE</th>
                            <th scope="col">EMPLEADO</th>
                            <th scope="col">FECHA</th>
                            <th scope="col">HORA</th>
                            <th scope="col">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            foreach ($rs3 as $k => $fila) {
                                $str = $fila["cliente"];
                                $str1 = $fila["empleado"];
                                $str2 = $fila["fecha"];
                                $str3 = $fila["hora"];
                            ?>
                                <td><?php echo resaltar($cliente, $str) ?></td>
                                <td><?php echo resaltar($empleado, $str1) ?></td>
                                <td><?php echo resaltar($fecha, $str2) ?></td>
                                <td><?php echo resaltar($hora, $str3) ?></td>
                                <td>
                                    <div style="display: flex; justify-content: space-between;">
                                        <form action="citas_modificar.php" name="formuModif<?php echo $fila["id_cita"]; ?>" method="post" style="padding-right: 5px;">
                                            <input type="hidden" name="id_cita" value="<?php echo $fila['id_cita'] ?>">
                                            <a class="btn btn-info" href="javascript:document.forms['formuModif<?php echo $fila["id_cita"]; ?>'].submit();" title="Modificar">MODIFICAR</a>
                                        </form>
                                        <form action="citas_eliminar.php" name="formElimi<?php echo $fila["id_cita"]; ?>" method="post">
                                            <input type="hidden" name="id_cita" value="<?php echo $fila['id_cita'] ?>">
                                            <a class="btn btn-danger" href="javascript:if(confirm('¿Desea realmente eliminar ala cita de fecha <?php echo $fila['fecha'] ?>')){ document.forms['<?php echo $fila['id_cita'] ?>'].submit(); }" title="Eliminar">ELIMINAR</a>
                                        </form>
                                    </div>
                                </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php
    } else { ?>
        <div class="d-flex justify-content-center">
            <h5>NO HAY DATOS</h5>
        </div>
<?php }
} ?>