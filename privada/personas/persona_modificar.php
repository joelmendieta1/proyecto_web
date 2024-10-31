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
$id_persona = $_POST["id_persona"];
?>
<?php include("../../header.php"); ?>
<br>
<link href="../../css/bootstrap.min.css" rel="stylesheet" />
<div style=" display: flex; justify-content: center;">
    <?php $sql = $db->Prepare("SELECT *
                     FROM personas
                     WHERE id_persona = ?
                     AND estado <> 'X'                        
                        ");
$rs = $db->GetAll($sql,array($id_persona));
foreach ($rs as $k => $fila) {  ?>
    <form action='persona_modificar1.php' method='post' name='formu' class="row g-3 formulary" style="width: 500px;background-color: white; color: black;border: 2px solid black">
        <h5 style="text-align: center;border-bottom: 2px solid black;">MODIFICAR PERSONA<br><br></h5>
        <div class="col-md-6">
            <label class="form-label">(*)cedula de identidad</label>
            <input type="text" name='ci' class="form-control" id="" value="<?php echo $fila["ci"]?>">
            <p name='tci'></p>
        </div>
        <div class="col-md-6">
            <label  class="form-label">Apellido Paterno</label>
            <input type="text" name='ap' class="form-control" id="" value="<?php echo $fila["ap"]?>">
            <p name='tpaterno'></p>
        </div>
        <div class="col-md-6">
            <label  class="form-label">Apellido Materno</label>
            <input type="text" name='am' class="form-control" id=""value="<?php echo $fila["am"]?>">
            <p name='tmaterno'></p>
        </div>
        <div class="col-md-6">
            <label  class="form-label">(*)Nombres</label>
            <input type="text" name='nombres' class="form-control" id="" value="<?php echo $fila["nombres"]?>">
            <p name='tnombres'></p>
        </div>
        <div class="col-md-6">
            <label  class="form-label">Direccion</label>
            <input type="text" name='direccion' class="form-control" id="" value="<?php echo $fila["direccion"]?>">
        </div>
        <div class="col-md-6">
            <label  class="form-label">Telefono</label>
            <input type="text" name='telefono' class="form-control" id="" value="<?php echo $fila["telefono"]?>">
        </div>
        <div class="col-12" style="text-align: center;">
            <label  class="form-label">(*) DATOS OBLIGATORIOS</label>
        </div>
        <div class="col-12" style="display: flex; justify-content: center; margin-bottom: 10px;">
            <input onclick="ValidarPersona()"; value="ACEPTAR"  type="button" class="btn btn-primary" style="margin-right: 10px; width: 150px;">
            <button onclick="location.href='personas.php'" type="reset" class="btn btn-danger" style="margin-left: 10px; width: 150px;">CANCELAR</button>
            <input type="hidden" name='id_persona' value="<?php echo $fila["id_persona"] ?>">
        </div>
    </form>
    <?php }?>
    <script src="../../js/bootstrap.bundle.min.js"></script>
    <script type='text/javascript' src='../js/validacion.js'></script>
</div>
<?php include("../../footer.php"); ?>