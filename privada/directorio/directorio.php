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
$sql = $db->Prepare(" SELECT  nombres as terapeuta
                    FROM    terapeutas 
                    WHERE   estado='A'
                    ");
$rs = $db->GetAll($sql);
?>
<link href="../../css/bootstrap.min.css" rel="stylesheet" />
<script type="text/javascript" src="../../ajax.js"></script>
<script type="text/javascript" src="./js/buscar.js"></script>
<script type="text/javascript" src="./js/buscar1.js"></script>
<br>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <a href="directorio_nuevo.php" class="btn btn-primary">Añadir Directorio</a>
        <h4 class="header m-auto ">Listado de Directorios</h4>
    </div>
    <div class="container">
        <form class="row g-3 justify-content-center" action="#" method="post" name="formu">
            <div class="col-auto" style="text-align: center;">
            <label class="form-label">TERAPEUTA</label>
                <select class="form-select" aria-label="Default select example" name="terapeuta" onchange="buscar()">
                <option value=""></option>';
                <?php foreach ($rs as $fila) {?>
                <option value="<?php echo $fila['terapeuta']?>"> <?php echo $fila['terapeuta']?> </option>';
                <?php }?>
                </select>
            </div>
            <div class="col-auto" style="text-align: center;">
                <label class="form-label">CARGO</label>
                <input type="text" class="form-control" name="cargos" onkeyup="buscar()">
            </div>
            <div class="col-auto" style="text-align: center;">
                <label class="form-label">FECHA INICIO</label>
                <input type="date" class="form-control" name="fecha_inicio" onchange="buscar()">
            </div>
        </form>
    </div>
    <br>
    <div class="container" id="directorios1">
        <div class="d-flex justify-content-center">
            <div class="table-responsive">
                <?php
                contarRegistros($db, "directorio");
                paginacion("directorio.php?");
                $sql = $db->Prepare("SELECT CONCAT_WS(' ', t.apellidos, t.nombres) AS terapeuta, d.* 
            FROM terapeutas t
            INNER JOIN directorio d ON d.id_terapeuta=t.id_terapeuta
            WHERE t.estado <> 'X' 
            AND d.estado <> 'X' 
            ORDER BY d.id_directorio DESC
            LIMIT ? OFFSET ?                        
            ");
                $rs = $db->GetAll($sql, array($nElem, $regIni));
                if ($rs) { ?>
                    <table class="table table-bordered border-dark">
                        <thead class="table-active" style="text-align: center;">
                            <tr>
                                <th scope="col">N°</th>
                                <th scope="col">TERAPEUTA</th>
                                <th scope="col">CARGOS</th>
                                <th scope="col">FECHA INICIO</th>
                                <th scope="col">FECHA FINAL</th>
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
                                    <td><?php echo $fila["terapeuta"]; ?></td>
                                    <td><?php echo $fila["cargos"]; ?></td>
                                    <td><?php echo $fila["fecha_inicio"]; ?></td>
                                    <td><?php echo $fila["fecha_final"]; ?></td>
                                    <td>
                                        <div style="display: flex; justify-content: space-between;">
                                            <form action="usuario_modificar.php" name="formuModif<?php echo $fila["id_directorio"]; ?>" method="post" style="padding-right: 5px;">
                                                <input type="hidden" name="id_directorio" value="<?php echo $fila['id_directorio'] ?>">
                                                <a class="btn btn-info" href="javascript:document.forms['<?php echo $fila["id_directorio"]; ?>'].submit();" title="Modificar">MODIDICAR</a>
                                            </form>
                                            <form action="usuario_eliminar.php" name="formElimi<?php echo $fila["id_directorio"]; ?>" method="post">
                                                <input type="hidden" name="id_directorio" value="<?php echo $fila['id_directorio'] ?>">
                                                <a class="btn btn-danger" href="javascript:if(confirm('¿Desea realmente eliminar al usuario<?php echo $fila['id_directorio'] ?>')){ document.forms['<?php echo $fila['id_directorio'] ?>'].submit(); }" title="Eliminar">ELIMINAR</a>
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