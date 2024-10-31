<?php
session_start();
require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");
$sql = $db->Prepare(" SELECT  *
                    FROM    tipos_clientes 
                    WHERE   estado='A'
                    ");
$rs = $db->GetAll($sql);

$cliente = $_POST["cliente"] ?? '';

if ($cliente) {
    $clienteArr = explode(' ', $cliente);
    $nombre = $clienteArr[0];
    $apellido = isset($clienteArr[1]) ? $clienteArr[1] : '';
    $sql3 = $db->Prepare("SELECT CONCAT_WS(' ', nombre, apellido) AS cliente, id_cliente
                          FROM clientes
                          WHERE nombre LIKE ? 
                          AND apellido LIKE ?
                          AND estado <> 'X'
                         ");
    $rs3 = $db->GetAll($sql3, array($nombre . "%", $apellido . "%"));
    if ($rs3) { ?>
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="header m-auto ">RESULTADO DE LA BUSQUEDA</h4>
        </div>
        <div class="d-flex justify-content-center">
            <div class="table-responsive">
                <table class="table table-bordered border-dark">
                    <thead class="table-active" style="text-align: center;">
                        <tr>
                            <th scope="col">CLIENTE</th>
                            <th scope="col">SELECCIONAR</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rs3 as $k => $fila) {
                            $str = $fila["cliente"]; ?>
                            <tr>
                                <td><?php echo resaltar($cliente, $str); ?></td>
                                <td style="text-align: center;">
                                    <input type="radio" name="opcion" value="" onclick='buscar_cliente("<?php echo $fila["id_cliente"] ?>")'>
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
                        <h5 class="header m-auto ">INSERTAR CLIENTE</h5>
                    </div>
                    <br>
                    <div class="container row g-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="header m-auto ">TIPO DE CLIENTE</h5>
                        </div>
                        <div class="col-auto m-auto">
                            <label class="form-label">(*)SELECIONE UN TIPO DE CLIENTE</label>
                            <select class="form-select" aria-label="Default select example" name="tipo1" id="validationAnyData" required>
                                <option value=""></option>
                                <?php foreach ($rs as $fila) { ?>
                                    <option value="<?php echo $fila['id_tipo_cliente'] ?>"> <?php echo $fila['nombre'] ?> </option>';
                                <?php } ?>
                            </select>
                            </select>
                            <div class="valid-feedback">
                                Correcto
                            </div>
                            <div class="invalid-feedback">
                                Selecionar
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-sm">
                            <label class="form-label">(*)Nombre</label>
                            <input type="text" class="form-control" name="nombre1" id="validationOnlyLetters" pattern="[A-Za-z]+" required>
                            <div class="valid-feedback">
                                Correcto
                            </div>
                            <div class="invalid-feedback">
                                El nombre esta vacio o Incorecto
                            </div>
                        </div>
                        <div class="col-sm">
                            <label class="form-label">(*)Apellido</label>
                            <input type="text" class="form-control" name="apellido1" id="validationOnlyLetters" pattern="[A-Z a-z]+" required>
                            <div class="valid-feedback">
                                Correcto
                            </div>
                            <div class="invalid-feedback">
                                El apellido esta vacio o Incorecto
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-sm">
                            <label class="form-label">(*)Telefono</label>
                            <input type="number" class="form-control" name="telefono1" id="validationOnlyNumbers" required>
                            <div class="valid-feedback">
                                Correcto
                            </div>
                            <div class="invalid-feedback">
                                El telefono esta vacio o Incorecto
                            </div>
                        </div>
                        <div class="col-sm">
                            <label class="form-label">(*)GENERO</label>
                            <select class="form-select" aria-label="Default select example" name="genero1" id="validationAnyData" required>
                                <option value=""></option>
                                <option value="M">Masculino</option>
                                <option value="F">Femenino</option>
                            </select>
                            </select>
                            <div class="valid-feedback">
                                Correcto
                            </div>
                            <div class="invalid-feedback">
                                Selecionar
                            </div>
                        </div>
                    </div>
                    <div class="container" style="text-align: center; padding-top: 20px;">
                        <input type="button" class="btn btn-success" value="ACEPTAR" onclick="insertar_cliente();">
                        <br>(*)Datos Obligatorios
                    </div>
                </form>
            </div>
        </div>
<?php }
}
?>
<script type='text/javascript' src='../js/validar.js'></script>