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
?>
<?php include("../../header.php"); 
$id_categoria_servicio = $_POST["id_categoria_servicio"];?>
<br>
<link href="../../css/bootstrap.min.css" rel="stylesheet" />
<div style=" display: flex; justify-content: center;">
    <?php $sql = $db->Prepare("SELECT *
                     FROM categorias_servicios
                     WHERE id_categoria_servicio = ?
                     AND estado <> 'X'                        
                        ");
$rs = $db->GetAll($sql,array($id_categoria_servicio));
foreach ($rs as $k => $fila) {  ?>
    <form action='categoria_modificar1.php' method='post' name='formu' class="row g-3 formulary" style="width: 500px;background-color: white; color: black;border: 2px solid black">
        <h5 style="text-align: center;border-bottom: 2px solid black;">MODIFICAR CATEGORIA<br><br></h5>
        <div class="col-12">
            <label class="form-label">(*)Nombre</label>
            <input type="text" name='nombre' class="form-control" id="" value="<?php echo $fila["nombre"]?>">
            <p name='tnombre'></p>
        </div>
        <div class="col-12" style="text-align: center;">
            <label  class="form-label">(*) DATOS OBLIGATORIOS</label>
        </div>
        <div class="col-12" style="display: flex; justify-content: center; margin-bottom: 10px;">
            <input onclick="ValidarCategoria()"; value="ACEPTAR"  type="button" class="btn btn-primary" style="margin-right: 10px; width: 150px;">
            <button onclick="location.href='categorias_servicios.php'" type="reset" class="btn btn-danger" style="margin-left: 10px; width: 150px;">CANCELAR</button>
            <input type="hidden" name='id_categoria_servicio' value="<?php echo$fila["id_categoria_servicio"] ?>">
        </div>
    </form>
    <?php }?>
    <script src="../../js/bootstrap.bundle.min.js"></script>
    <script type='text/javascript' src='../js/validacion.js'></script>
</div>
<?php include("../../footer.php"); ?>