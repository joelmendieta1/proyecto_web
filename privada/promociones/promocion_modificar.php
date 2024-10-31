<?php
// Iniciar sesión
session_start();
require_once("../../conexion.php");
// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION["sesion_id_rol"])) {
    // Si no ha iniciado sesión, redirigir al login
    header("Location: index.php");
    exit();
}
$id_promocion = $_POST["id_promocion"];
?>
<?php include("../../header.php"); ?>
<br>
<link href="../../css/bootstrap.min.css" rel="stylesheet" />
<div style=" display: flex; justify-content: center;">
    <?php $sql = $db->Prepare("SELECT *
                     FROM promociones
                     WHERE id_promocion = ?
                     AND estado <> 'X'                        
                        ");
$rs = $db->GetAll($sql,array($id_promocion));
foreach ($rs as $k => $fila) {  ?>
    <form action='promocion_modificar1.php' method='post' name='formu' class="row g-3 formulary" style="width: 500px;background-color: white; color: black;border: 2px solid black">
        <h5 style="text-align: center;border-bottom: 2px solid black;">MODIFICAR PROMOCION<br><br></h5>
        <div class="col-md-6">
            <label class="form-label">(*)Descuento</label>
            <input type="text" name='descuento' class="form-control" id="" value="<?php echo $fila["descuento"]?>">
            <p name='tdescuento'></p>
        </div>
        <div class="col-md-6">
            <label class="form-label">(*)Descripcion</label>
            <input type="text" name='descripcion' class="form-control" id="" value="<?php echo $fila["descripcion"]?>">
            <p name='tdescripcion'></p>
        </div>
        <div class="col-md-6">
            <label class="form-label">(*)Fecha Inicio</label>
            <input type="date" name='fecha_inicio' class="form-control" id="" value="<?php echo $fila["fecha_inicio"]?>">
            <p name='tfecha_inicio'></p>
        </div>
        <div class="col-md-6">
            <label class="form-label">(*)Fecha Fin</label>
            <input type="date" name='fecha_fin' class="form-control" id="" value="<?php echo $fila["fecha_fin"]?>">
            <p name='tfecha_fin'></p>
        </div>
        <div class="col-12" style="text-align: center;">
            <label  class="form-label">(*) DATOS OBLIGATORIOS</label>
        </div>
        <div class="col-12" style="display: flex; justify-content: center; margin-bottom: 10px;">
            <input onclick="ValidarPromocion()"; value="ACEPTAR"  type="button" class="btn btn-primary" style="margin-right: 10px; width: 150px;">
            <button onclick="location.href='promociones.php'" type="reset" class="btn btn-danger" style="margin-left: 10px; width: 150px;">CANCELAR</button>
            <input type="hidden" name='id_promocion' value="<?php echo $fila["id_promocion"] ?>">
        </div>
    </form>
    <?php }?>
    <script src="../../js/bootstrap.bundle.min.js"></script>
    <script type='text/javascript' src='../js/validacion.js'></script>
</div>
<?php include("../../footer.php"); ?>