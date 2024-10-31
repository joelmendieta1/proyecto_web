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
        <a href="empleado_nuevo.php" class="btn btn-primary">Añadir Empleado</a>
        <h4 class="header m-auto ">Listado de Empleados</h4>
    </div>
    <br>
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="table-responsive">
                <?php
                contarRegistros($db, "empleados");
                paginacion("empleados.php?");
                $sql = $db->Prepare("SELECT e.*  
            FROM empleados e
            WHERE e.estado <> 'X'
            ORDER BY e.id_empleado DESC
            LIMIT ? OFFSET ?                        
            ");
                $rs = $db->GetAll($sql, array($nElem, $regIni));
                if ($rs) { ?>
                    <table class="table table-bordered border-dark">
                        <thead class="table-active" style="text-align: center;">
                            <tr>
                                <th scope="col">N°</th>
                                <th scope="col">NOMBRE</th>
                                <th scope="col">APELLIDO PATERNO</th>
                                <th scope="col">APELLIDO MATERNO</th>
                                <th scope="col">CI</th>
                                <th scope="col">TELEFONO</th>
                                <th scope="col">FECHA INICIO</th>
                                <th scope="col">FECHA FIN</th>
                                <th scope="col">ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $b = 0;
                            $total = $pag - 1;
                            $a = $nElem * $total;
                            $b = $b + 1 + $a;
                            foreach ($rs as $k => $fila) {  ?>
                                <tr>
                                    <td><?php echo $b ?></td>
                                    <td><?php echo $fila["nombre"]; ?></td>
                                    <td><?php echo $fila["ap"]; ?></td>
                                    <td><?php echo $fila["am"]; ?></td>
                                    <td><?php echo $fila["ci"]; ?></td>
                                    <td><?php echo $fila["telefono"]; ?></td>
                                    <td><?php echo $fila["fecha_inicio"]; ?></td>
                                    <td><?php echo $fila["fecha_fin"]; ?></td>
                                    <td>
                                        <div style="display: flex; justify-content: space-between;">
                                            <form action="empleado_modificar.php" name="formuModif<?php echo $fila["id_empleado"]; ?>" method="post" style="padding-right: 5px;">
                                                <input type="hidden" name="id_empleado" value="<?php echo $fila['id_empleado'] ?>">
                                                <a class="btn btn-info" href="javascript:document.forms['formuModif<?php echo $fila["id_empleado"]; ?>'].submit();" title="Modificar">MODIFICAR</a>
                                            </form>
                                            <form action="empleado_eliminar.php" name="formElimi<?php echo $fila["id_empleado"]; ?>" method="post">
                                                <input type="hidden" name="id_empleado" value="<?php echo $fila['id_empleado'] ?>">
                                                <a class="btn btn-danger" href="javascript:if(confirm('¿Desea realmente eliminar al empleado <?php echo $fila['nombre'], ' ', $fila['ap'] ?>')){ document.forms['formElimi<?php echo $fila['id_empleado'] ?>'].submit(); }" title="Eliminar">ELIMINAR</a>
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
