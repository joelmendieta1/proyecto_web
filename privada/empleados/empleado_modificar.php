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
$id_empleado = $_POST["id_empleado"];
?>
<?php include("../../header.php"); ?>

<br>
<link href="../../css/bootstrap.min.css" rel="stylesheet" />
<div style=" display: flex; justify-content: center;">
    <?php $sql = $db->Prepare("SELECT *
                     FROM empleados
                     WHERE id_empleado = ?
                     AND estado <> 'X'                        
                        ");
$rs = $db->GetAll($sql,array($id_empleado));
foreach ($rs as $k => $fila) {  ?>
    <form action='empleado_modificar1.php' method='post' name='formu' class="row g-3 formulary" style="width: 500px;background-color: white; color: black;border: 2px solid black">
        <h5 style="text-align: center;border-bottom: 2px solid black;">MODIFICAR EMPLEADO<br><br></h5>
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
            <input type="text" name='nombre' class="form-control" id="" value="<?php echo $fila["nombre"]?>">
            <p name='tnombre'></p>
        </div>
        <div class="col-md-6">
            <label  class="form-label">Telefono</label>
            <input type="text" name='telefono' class="form-control" id="" value="<?php echo $fila["telefono"]?>">
            <p name='ttelefono'></p>
        </div>
        <div class="col-md-6">
            <label  class="form-label">Fecha Inicio</label>
            <input type="date" name='fecha_inicio' class="form-control" id="" value="<?php echo $fila["fecha_inicio"]?>">
            <p name='tfecha_inicio'></p>
        </div>
        <div class="col-md-6">
            <label  class="form-label">Fecha_Fin</label>
            <input type="date" name='fecha_fin' class="form-control" id="" value="<?php echo $fila["fecha_fin"]?>">
        </div>
        <div class="col-12" style="text-align: center;">
            <label  class="form-label">(*) DATOS OBLIGATORIOS</label>
        </div>
        <div class="col-12" style="display: flex; justify-content: center; margin-bottom: 10px;">
            <input onclick="ValidarEmpleado()"; value="ACEPTAR"  type="button" class="btn btn-primary" style="margin-right: 10px; width: 150px;">
            <button onclick="location.href='empleados.php'" type="reset" class="btn btn-danger" style="margin-left: 10px; width: 150px;">CANCELAR</button>
            <input type="hidden" name='id_empleado' value="<?php echo $fila["id_empleado"] ?>">
        </div>
    </form>
    <?php }?>
    <script src="../../js/bootstrap.bundle.min.js"></script>
    <script type='text/javascript' src='../js/validacion.js'></script>
</div>
<?php include("../../footer.php"); ?>