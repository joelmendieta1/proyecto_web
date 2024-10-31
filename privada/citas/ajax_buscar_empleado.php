<?php
session_start();
require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");

$empleado = $_POST["empleado"] ?? '';

if ($empleado) {
    $empleadoArr = explode(' ', $empleado);
    $nombre = $empleadoArr[0];
    $ap = isset($empleadoArr[1]) ? $empleadoArr[1] : '';
    $am = isset($empleadoArr[2]) ? $empleadoArr[2] : '';
    $sql3 = $db->Prepare("SELECT CONCAT_WS(' ', nombre, ap,am) AS empleado, id_empleado
                          FROM empleados
                          WHERE nombre LIKE ? 
                          AND ap LIKE ?
                          AND am LIKE ?
                          AND estado <> 'X'
                         ");
    $rs3 = $db->GetAll($sql3, array($nombre . "%", $ap . "%", $am . "%"));
    if ($rs3) { ?>
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="header m-auto ">RESULTADO DE LA BUSQUEDA</h4>
        </div>
        <div class="d-flex justify-content-center">
            <div class="table-responsive">
                <table class="table table-bordered border-dark">
                    <thead class="table-active" style="text-align: center;">
                        <tr>
                            <th scope="col">empleado</th>
                            <th scope="col">SELECCIONAR</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rs3 as $k => $fila) {
                            $str = $fila["empleado"]; ?>
                            <tr>
                                <td><?php echo resaltar($empleado, $str); ?></td>
                                <td style="text-align: center;">
                                    <input type="radio" name="opcion" value="" onclick='buscar_empleado("<?php echo $fila["id_empleado"] ?>")'>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php } else { ?>
        <div class="card">
            <div class="container">
                <form class="justify-content-center" action="" name="formu">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="header m-auto ">INSERTAR EMPLEADO</h5>
                    </div>
                    <br>
                    <div class="row g-3">
                        <div class="col-sm">
                            <label class="form-label">(*)Nombre</label>
                            <input type="text" class="form-control" name="nombre1" id="validationOnlyLetters" required>
                            <div class="valid-feedback">
                                Correcto
                            </div>
                            <div class="invalid-feedback">
                                El nombre esta vacio o Incorecto
                            </div>
                        </div>
                        <div class="col-sm">
                            <label class="form-label">(*)Apellido Paterno</label>
                            <input type="text" class="form-control" name="ap1" id="validationOnlyLetters" required>
                            <div class="valid-feedback">
                                Correcto
                            </div>
                            <div class="invalid-feedback">
                                El apellido Pateno esta vacio o Incorecto
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-sm">
                            <label class="form-label">(*)Apellido Materno</label>
                            <input type="text" class="form-control" name="am1" id="validationOnlyLetters" required>
                            <div class="valid-feedback">
                                Correcto
                            </div>
                            <div class="invalid-feedback">
                                El apellido Materno esta vacio o Incorecto
                            </div>
                        </div>
                        <div class="col-sm">
                            <label class="form-label">(*)Cedula</label>
                            <input type="text" class="form-control" name="ci1" id="validationOnlyLetters" required>
                            <div class="valid-feedback">
                                Correcto
                            </div>
                            <div class="invalid-feedback">
                                LA cedula esta vacia o Incorecta
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-sm">
                            <label class="form-label">(*)Telefono</label>
                            <input type="text" class="form-control" name="telefono2" id="validationOnlyLetters" required>
                            <div class="valid-feedback">
                                Correcto
                            </div>
                            <div class="invalid-feedback">
                                El telefono esta vacio o Incorecto
                            </div>
                        </div>
                        <div class="col-sm">
                            <label class="form-label">(*)Fecha Inicio</label>
                            <input type="date" class="form-control" name="fecha_inicio1" id="validationOnlyLetters" required>
                            <div class="valid-feedback">
                                Correcto
                            </div>
                            <div class="invalid-feedback">
                                La fecha esta vacia o Incorecto
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-sm">
                            <label class="form-label">Fecha Fin</label>
                            <input type="date" class="form-control" name="fecha_fin1">
                        </div>
                        <div class="col-sm">
                        </div>
                    </div>
                    <div class="container" style="text-align: center; padding-top: 20px;">
                        <input type="button" class="btn btn-success" value="ACEPTAR" onclick="insertar_empleado();">
                        <br>(*)Datos Obligatorios
                    </div>
                </form>
            </div>
        </div>
<?php }
}
?>
<script type='text/javascript' src='../js/validar.js'></script>