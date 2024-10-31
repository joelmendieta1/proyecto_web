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
        <a href="cliente_nuevo.php" class="btn btn-primary">Añadir Cliente</a>
        <h4 class="header m-auto ">Listado de Clientes</h4>
    </div>
    <br>
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="table-responsive">
                <?php
                contarRegistros($db, "clientes");
                paginacion("clientes.php?");
                $sql = $db->Prepare("SELECT t.nombre as tipo, IF(c.genero = 'M', 'Masculino', 'Femenino') as Genero, c.*  
            FROM clientes c
            INNER JOIN tipos_clientes as t ON t.id_tipo_cliente=c.id_tipo_cliente
            WHERE c.estado <> 'X' 
            AND t.estado <> 'X' 
            ORDER BY c.id_cliente DESC
            LIMIT ? OFFSET ?                        
            ");
                $rs = $db->GetAll($sql, array($nElem, $regIni));
                if ($rs) { ?>
                    <table class="table table-bordered border-dark">
                        <thead class="table-active" style="text-align: center;">
                            <tr>
                                <th scope="col">N°</th>
                                <th scope="col">TIPO DE CLIENTE</th>
                                <th scope="col">NOMBRE</th>
                                <th scope="col">APELLIDO</th>
                                <th scope="col">TELEFONO</th>
                                <th scope="col">GENERO</th>
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
                                    <td><?php echo $fila["tipo"]; ?></td>
                                    <td><?php echo $fila["nombre"]; ?></td>
                                    <td><?php echo $fila["apellido"]; ?></td>
                                    <td><?php echo $fila["telefono"]; ?></td>
                                    <td><?php echo $fila["Genero"]; ?></td>
                                    <td>
                                        <div style="display: flex; justify-content: space-between;">
                                            <form action="cliente_modificar.php" name="formuModif<?php echo $fila["id_cliente"]; ?>" method="post" style="padding-right: 5px;">
                                                <input type="hidden" name="id_cliente" value="<?php echo $fila['id_cliente'] ?>">
                                                <a class="btn btn-info" href="javascript:document.forms['formuModif<?php echo $fila["id_cliente"]; ?>'].submit();" title="Modificar">MODIFICAR</a>
                                            </form>
                                            <form action="cliente_eliminar.php" name="formElimi<?php echo $fila["id_cliente"]; ?>" method="post">
                                                <input type="hidden" name="id_cliente" value="<?php echo $fila['id_cliente'] ?>">
                                                <a class="btn btn-danger" href="javascript:if(confirm('¿Desea realmente eliminar al cliente <?php echo $fila['nombre'], ' ', $fila['apellido'] ?>')){ document.forms['formElimi<?php echo $fila['id_cliente'] ?>'].submit(); }" title="Eliminar">ELIMINAR</a>
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