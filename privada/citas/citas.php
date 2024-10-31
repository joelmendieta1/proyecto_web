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
<script type="text/javascript" src="../../ajax.js"></script>
<script type="text/javascript" src="./js/buscar_cita.js"></script>
<br>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <a href="citas_nuevo.php" class="btn btn-primary">Añadir Cita</a>
        <h4 class="header m-auto ">Listado de citas</h4>
    </div>
    <div class="container">
        <form class="row g-3 justify-content-center" action="#" method="post" name="formu">
            <div class="col-auto" style="text-align: center;">
                <label class="form-label">CLIENTE</label>
                <input type="text" class="form-control" name="cliente" onkeyup="buscar()">
            </div>
            <div class="col-auto" style="text-align: center;">
                <label class="form-label">EMPLEADO</label>
                <input type="text" class="form-control" name="empleado" onkeyup="buscar()">
            </div>
            <div class="col-auto" style="text-align: center;">
                <label class="form-label">FECHA</label>
                <input type="date" class="form-control" name="fecha" onchange="buscar()">
            </div>
            <div class="col-auto" style="text-align: center;">
                <label class="form-label">HORA</label>
                <input type="time" class="form-control" name="hora" onchange="buscar()">
            </div>
        </form>
    </div>
    <br>
    <div class="container" id="citas1">
        <div class="d-flex justify-content-center">
            <div class="table-responsive">
                <?php
                contarRegistros($db, "citas");
                paginacion("citas.php?");
                $sql = $db->Prepare("SELECT CONCAT_WS(' ', cl.nombre, cl.apellido) AS cliente,CONCAT_WS(' ', e.nombre, e.ap) AS empleado,  c.* 
            FROM citas c
            INNER JOIN clientes as cl ON cl.id_cliente=c.id_cliente
            INNER JOIN empleados as e ON e.id_empleado=c.id_empleado
            WHERE c.estado <> 'X' 
            AND cl.estado <> 'X'
            AND e.estado <> 'X' 
            ORDER BY c.id_cita DESC
            LIMIT ? OFFSET ?                        
            ");
                $rs = $db->GetAll($sql, array($nElem, $regIni));
                if ($rs) { ?>
                    <table class="table table-bordered border-dark">
                        <thead class="table-active" style="text-align: center;">
                            <tr>
                                <th scope="col">N°</th>
                                <th scope="col">CLIENTE</th>
                                <th scope="col">EMPLEADO</th>
                                <th scope="col">FECHA</th>
                                <th scope="col">HORA</th>
                                <th scope="col">ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $b = 0;
                            $total = $pag - 1;
                            $a = $nElem * $total;
                            $b = $b + 1 + $a;
                            foreach ($rs as $k => $fila) {  ?>
                                <tr>
                                    <td><?php echo $b ?></td>
                                    <td><?php echo $fila["cliente"]; ?></td>
                                    <td><?php echo $fila["empleado"]; ?></td>
                                    <td><?php echo $fila["fecha"]; ?></td>
                                    <td><?php echo $fila["hora"]; ?></td>
                                    <td>
                                        <div style="display: flex; justify-content: space-between;">
                                            <form action="citas_modificar.php" name="formuModif<?php echo $fila["id_cita"]; ?>" method="post" style="padding-right: 5px;">
                                                <input type="hidden" name="id_cita" value="<?php echo $fila['id_cita'] ?>">
                                                <a class="btn btn-info" href="javascript:document.forms['formuModif<?php echo $fila["id_cita"]; ?>'].submit();" title="Modificar">MODIFICAR</a>
                                            </form>
                                            <form action="citas_eliminar.php" name="formElimi<?php echo $fila["id_cita"]; ?>" method="post">
                                                <input type="hidden" name="id_cita" value="<?php echo $fila['id_cita'] ?>">
                                                <a class="btn btn-danger" href="javascript:if(confirm('¿Desea realmente eliminar al cliente <?php echo $fila['fecha'], ' ', $fila['hora'] ?>')){ document.forms['formElimi<?php echo $fila['id_cita'] ?>'].submit(); }" title="Eliminar">ELIMINAR</a>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                                $b = $b + 1;
                            } ?>
                        </tbody>
                    </table>
                <?php } ?>
            </div>
        </div>
        <?php paginacion1(); ?>
    </div>
</div>


<script src="../../js/bootstrap.bundle.min.js"></script>
<?php require_once("../../footer.php"); ?>