<?php
// Iniciar sesión
session_start();
require_once("../../conexion.php");
require_once("../../paginacion.inc.php");
require_once("../../header.php");

if (!isset($_SESSION["sesion_id_rol"])) {
    header("Location: index.php");
    exit();
}
?>
<link href="../../css/bootstrap.min.css" rel="stylesheet" />
<br>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <a href="detalle_servicio_nuevo.php" class="btn btn-primary">Añadir Detalle de Servicio</a>
        <h4 class="header m-auto ">Listado de Detalles de Servicios</h4>
    </div>
    <br>
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="table-responsive">
                <?php
                contarRegistros($db, "detalles_servicios");
                paginacion("detalles_servicios.php?");
                
                // Consulta SQL para obtener el listado de detalles de servicios, uniendo clientes, empleados y categorías de servicio
                $sql = $db->Prepare("
                    SELECT 
                        ds.id_detalle_servicio,
                        CONCAT(cl.nombre, ' ', cl.apellido) AS cliente, 
                        CONCAT(em.nombre, ' ', em.ap, ' ', em.am) AS empleado, 
                        cs.nombre AS categoria_servicio, 
                        ci.fecha, 
                        ci.hora, 
                        ds.precio, 
                        ds.descipcion
                    FROM detalles_servicios ds
                    INNER JOIN citas ci ON ds.id_cita = ci.id_cita
                    INNER JOIN clientes cl ON ci.id_cliente = cl.id_cliente
                    INNER JOIN empleados em ON ci.id_empleado = em.id_empleado
                    INNER JOIN categorias_servicios cs ON ds.id_categoria_servicio = cs.id_categoria_servicio
                    WHERE ds.estado <> 'X' 
                    ORDER BY ds.id_detalle_servicio DESC
                    LIMIT ? OFFSET ?
                ");
                
                // Ejecutar la consulta con la paginación
                $rs = $db->GetAll($sql, array($nElem, $regIni));

                if ($rs) { ?>
                    <table class="table table-bordered border-dark">
                        <thead class="table-active" style="text-align: center;">
                            <tr>
                                <th scope="col">N°</th>
                                <th scope="col">Cliente</th>
                                <th scope="col">Empleado</th>
                                <th scope="col">Servicio</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Hora</th>
                                <th scope="col">Precio</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $b = 0;
                            $total = $pag - 1;
                            $a = $nElem * $total;
                            $b = $b + 1 + $a;

                            foreach ($rs as $fila) {  ?>
                                <tr>
                                    <td><?php echo $b ?></td>
                                    <td><?php echo $fila["cliente"]; ?></td>
                                    <td><?php echo $fila["empleado"]; ?></td>
                                    <td><?php echo $fila["categoria_servicio"]; ?></td>
                                    <td><?php echo $fila["fecha"]; ?></td>
                                    <td><?php echo $fila["hora"]; ?></td>
                                    <td><?php echo $fila["precio"]; ?></td>
                                    <td><?php echo $fila["descipcion"]; ?></td>
                                    <td>
                                        <div style="display: flex; justify-content: space-between;">
                                            <!-- Botón para modificar el detalle del servicio -->
                                            <form action="detalle_servicio_modificar.php" name="formuModif<?php echo $fila["id_detalle_servicio"]; ?>" method="post" style="padding-right: 5px;">
                                                <input type="hidden" name="id_detalle_servicio" value="<?php echo $fila['id_detalle_servicio'] ?>">
                                                <a class="btn btn-info" href="javascript:document.forms['formuModif<?php echo $fila["id_detalle_servicio"]; ?>'].submit();" title="Modificar">MODIFICAR</a>
                                            </form>

                                            <!-- Botón para eliminar el detalle del servicio -->
                                            <form action="detalle_servicio_eliminar.php" name="formElimi<?php echo $fila["id_detalle_servicio"]; ?>" method="post">
                                                <input type="hidden" name="id_detalle_servicio" value="<?php echo $fila['id_detalle_servicio'] ?>">
                                                <a class="btn btn-danger" href="javascript:if(confirm('¿Desea realmente eliminar el detalle del servicio <?php echo $fila['descipcion'] ?>')){ document.forms['formElimi<?php echo $fila['id_detalle_servicio'] ?>'].submit(); }" title="Eliminar">ELIMINAR</a>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                                $b = $b + 1;
                            } ?>
                        </tbody>
                    </table>
                <?php } else { ?>
                    <div class="alert alert-danger" role="alert">
                        No se encontraron registros.
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php paginacion1(); ?>
    </div>
</div>

<script src="../../js/bootstrap.bundle.min.js"></script>
<?php require_once("../../footer.php"); ?>
