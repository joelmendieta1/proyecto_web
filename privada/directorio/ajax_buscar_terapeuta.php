<?php
session_start();
require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");

$nombres = $_POST["nombres"];
$apellidos = $_POST["apellidos"];
$ci = $_POST["ci"];
$profesion = $_POST["profesion"];

if ($nombres || $apellidos || $ci || $profesion) {
    $sql3 = $db->Prepare("SELECT *
                          FROM terapeutas
                          WHERE nombres LIKE ?
                          AND apellidos LIKE ?
                          AND ci LIKE ? 
                          AND profesion LIKE ?
                          AND estado <> 'X'
                         ");
    $rs3 = $db->GetAll($sql3, array($nombres . "%", $apellidos . "%", $ci . "%", $profesion . "%"));
    if ($rs3) { ?>
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="header m-auto ">RESULTADO DE LA BUSQUEDA</h4>
        </div>
        <div class="d-flex justify-content-center">
            <div class="table-responsive">
                <table class="table table-bordered border-dark">
                    <thead class="table-active" style="text-align: center;">
                        <tr>
                            <th scope="col">NOMBRES</th>
                            <th scope="col">APELLIDOS</th>
                            <th scope="col">CEDULA</th>
                            <th scope="col">PROFESION</th>
                            <th scope="col">SELECCIONAR</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rs3 as $k => $fila) {
                            $str = $fila["nombres"];
                            $str1 = $fila["apellidos"];
                            $str2 = $fila["ci"];
                            $str3 = $fila["profesion"]; ?>
                            <tr>
                                <td><?php echo resaltar($nombres, $str); ?></td>
                                <td><?php echo resaltar($apellidos, $str1); ?></td>
                                <td><?php echo resaltar($ci, $str2); ?></td>
                                <td><?php echo resaltar($profesion, $str3); ?></td>
                                <td style="text-align: center;">
                                    <input type="radio" name="opcion" value="" onclick='buscar_terapeuta("<?php echo $fila["id_terapeuta"] ?>")'>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php } else { ?>
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="header m-auto ">EL TERAPEUTA NO EXISTE</h5>
        </div>
        <br>
        <div class="card">
            <div class="container">
                <form class="justify-content-center" action="" name="formu">
                    <br>
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="header m-auto ">INSERTAR TERAPEUTA</h5>
                    </div>
                    <br>
                    <div class="row g-3">
                        <div class="col-sm">
                            <label class="form-label">(*)Nombres</label>
                            <input type="text" class="form-control" name="nombres1">
                        </div>
                        <div class="col-sm">
                            <label class="form-label">(*)Apellidos</label>
                            <input type="text" class="form-control" name="apellidos1">
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-sm">
                            <label class="form-label">(*)Cedula</label>
                            <input type="text" class="form-control" name="ci1">
                        </div>
                        <div class="col-sm">
                            <label class="form-label">(*)Direccion</label>
                            <input type="text" class="form-control" name="direccion1">
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-sm">
                            <label class="form-label">(*)Telefono</label>
                            <input type="text" class="form-control" name="telefono1">
                        </div>
                        <div class="col-sm">
                            <label class="form-label">(*)Profesion</label>
                            <input type="text" class="form-control" name="profesion1">
                        </div>
                    </div>
                    <div class="container" style="text-align: center; padding-top: 20px;">
                        <input type="button" class="btn btn-success" value="ACEPTAR" onclick="insertar_terapeuta();">
                        <br>(*)Datos Obligatorios
                    </div>
                </form>
            </div>
        </div>
<?php }
}
?>