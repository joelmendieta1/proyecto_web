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
$sql = $db->Prepare(" SELECT  * 
                    FROM    personas
                    WHERE   estado='A'
                    ");
$rs = $db->GetAll($sql);
?>
<link href="../../css/bootstrap.min.css" rel="stylesheet" />
<script type="text/javascript" src="../../ajax.js"></script>
<script type="text/javascript" src="./js/buscar.js"></script>
<br>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <a href="persona_nuevo.php" class="btn btn-primary">Añadir Persona</a>
        <h4 class="header m-auto ">Listado de Personas</h4>
    </div>
    <div class="container">
        <form class="row g-3 justify-content-center" action="#" method="post" name="formu">
            <div class="col-auto" style="text-align: center;">
                <label class="form-label">PERSONA</label>
                <input type="text" class="form-control" name="persona" onkeyup="buscar()">
            </div>
            <div class="col-auto" style="text-align: center;">
                <label class="form-label">USUARIO</label>
                <input type="text" class="form-control" name="usuario" onkeyup="buscar()">
            </div>
        </form>
    </div>
    <br>
    <div class="container" id="usuarios1">
        <div class="d-flex justify-content-center">
            <div class="table-responsive">
                <?php
                contarRegistros($db, "personas");
                paginacion("personas.php?");
                $sql = $db->Prepare("SELECT CONCAT_WS(' ', p.ap, p.am, p.nombres) AS persona, u.* 
            FROM personas p
            INNER JOIN usuarios u ON u.id_persona=p.id_persona
            WHERE p.estado <> 'X' 
            AND u.estado <> 'X' 
            ORDER BY id_usuario DESC
            LIMIT ? OFFSET ?                        
            ");
                $rs = $db->GetAll($sql, array($nElem, $regIni));
                if ($rs) { ?>
                    <table class="table table-bordered border-dark">
                        <thead class="table-active" style="text-align: center;">
                            <tr>
                                <th scope="col">N°</th>
                                <th scope="col">PERSONA</th>
                                <th scope="col">USUARIO</th>
                                <th scope="col">CLAVE</th>
                                <th scope="col">ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody >
                            <?php $b = 0;
                            $total = $pag - 1;
                            $a = $nElem * $total;
                            $b = $b + 1 + $a;
                            foreach ($rs as $k => $fila) {  ?>
                                <tr>
                                    <td><?php echo $b ?></td>
                                    <td><?php echo $fila["persona"]; ?></td>
                                    <td><?php echo $fila["usuario"]; ?></td>
                                    <td></td>
                                    <td>
                                        <div style="display: flex; justify-content: space-between;">
                                            <form action="usuario_modificar.php" name="formuModif<?php echo $fila["id_usuario"]; ?>" method="post" style="padding-right: 5px;">
                                                <input type="hidden" name="id_usuario" value="<?php echo $fila['id_usuario'] ?>">
                                                <a class="btn btn-info" href="javascript:document.forms['<?php echo $fila["id_usuario"]; ?>'].submit();" title="Modificar">MODIDICAR</a>
                                            </form>
                                            <form action="usuario_eliminar.php" name="formElimi<?php echo $fila["id_usuario"]; ?>" method="post">
                                                <input type="hidden" name="id_usuario" value="<?php echo $fila['id_usuario'] ?>">
                                                <a class="btn btn-danger" href="javascript:if(confirm('¿Desea realmente eliminar al usuario<?php echo $fila['id_usuario'] ?>')){ document.forms['<?php echo $fila['id_usuario'] ?>'].submit(); }" title="Eliminar">ELIMINAR</a>
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
            <?php paginacion1(); ?>
        </div>
    </div>
</div>


<script src="../../js/bootstrap.bundle.min.js"></script>
<?php require_once("../../footer.php"); ?>