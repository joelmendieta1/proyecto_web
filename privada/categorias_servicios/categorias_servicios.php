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
        <a href="categoria_nuevo.php" class="btn btn-primary">Añadir Categoría de Servicio</a>
        <h4 class="header m-auto ">Listado de Categorías de Servicios</h4>
    </div>
    <br>
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="table-responsive">
                <?php
                contarRegistros($db, "categorias_servicios");
                paginacion("categorias_servicios.php?");
                $sql = $db->Prepare("SELECT cs.id_categoria_servicio, cs.nombre  
            FROM categorias_servicios cs
            WHERE cs.estado <> 'X'
            ORDER BY cs.id_categoria_servicio DESC
            LIMIT ? OFFSET ?                        
            ");
                $rs = $db->GetAll($sql, array($nElem, $regIni));
                if ($rs) { ?>
                    <table class="table table-bordered border-dark">
                        <thead class="table-active" style="text-align: center;">
                            <tr>
                                <th scope="col">N°</th>
                                <th scope="col">NOMBRE</th>
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
                                    <td>
                                        <div style="display: flex; justify-content: space-between;">
                                            <form action="categoria_modificar.php" name="formuModif<?php echo $fila["id_categoria_servicio"]; ?>" method="post" style="padding-right: 5px;">
                                                <input type="hidden" name="id_categoria_servicio" value="<?php echo $fila['id_categoria_servicio'] ?>">
                                                <a class="btn btn-info" href="javascript:document.forms['formuModif<?php echo $fila["id_categoria_servicio"]; ?>'].submit();" title="Modificar">MODIFICAR</a>
                                            </form>
                                            <form action="categoria_eliminar.php" name="formElimi<?php echo $fila["id_categoria_servicio"]; ?>" method="post">
                                                <input type="hidden" name="id_categoria_servicio" value="<?php echo $fila['id_categoria_servicio'] ?>">
                                                <a class="btn btn-danger" href="javascript:if(confirm('¿Desea realmente eliminar la categoría de servicio <?php echo $fila['nombre'] ?>')){ document.forms['formElimi<?php echo $fila['id_categoria_servicio'] ?>'].submit(); }" title="Eliminar">ELIMINAR</a>
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
