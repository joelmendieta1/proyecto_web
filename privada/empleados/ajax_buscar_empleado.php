<?php
session_start();
require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");

$ap = $_POST["ap"];
$am = $_POST["am"];
$nombre = $_POST["nombre"];
$ci = $_POST["ci"];

if ($ap or $am or $nombre or $ci) {
    $sql3 = $db->Prepare("SELECT *
    FROM empleados
    WHERE ap LIKE ?
    AND am LIKE ?
    AND nombre LIKE ?
    AND ci LIKE ?
    AND estado <> 'X'");
    $rs3 = $db->GetAll($sql3, array($ap . "%", $am . "%", $nombre . "%", $ci . "%"));
?>
    <?php if ($rs3) { ?>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">APELLIDO PATERNO</th>
                                <th scope="col">APELLIDO MATERNO</th>
                                <th scope="col">NOMBRES</th>
                                <th scope="col">CEDULA</th>
                                <th scope="col">CEDULA</th>
                            </tr>
                        </thead>
                        <?php foreach ($rs3 as $k => $fila) {
                            $str = $fila["ap"];
                            $str1 = $fila["am"];
                            $str2 = $fila["nombre"];
                            $str3 = $fila["ci"]; ?>
                            <tbody>
                                <tr>
                                    <td><?php resaltar($ap, $str); ?></td>
                                    <td><?php resaltar($am, $str1); ?></td>
                                    <td><?php resaltar($nombre, $str2); ?></td>
                                    <td><?php resaltar($ci, $str3); ?></td>
                                    <td>
                                        <a class="btn btn-info" role="button" href="#" onclick="modificarEmpleado(<?php echo $fila['id_empleado']; ?>)">Modificar</a>
                                        <a class="btn btn-danger" role="button" href="#"
                                            data-id-empleado="<?php echo $fila['id_empleado']; ?>"
                                            data-nombre="<?php echo $fila['nombre']; ?>"
                                            data-ap="<?php echo $fila['ap']; ?>"
                                            data-am="<?php echo $fila['am']; ?>"
                                            onclick="mostrarMensaje(this)">
                                            Eliminar
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    <?php
    } else { ?>
        <p>no existe</p>
<?php }
}
?>
</div>