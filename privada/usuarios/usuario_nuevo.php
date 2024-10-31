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
$sql = $db->Prepare("SELECT CONCAT_WS(' ' ,ap, am, nombres) as persona, id_persona
FROM personas
WHERE estado = 'A'                        
   ");
$rs = $db->GetAll($sql);?>
<br>
<link href="../../css/bootstrap.min.css" rel="stylesheet" />
<div style=" display: flex; justify-content: center;">
    <form action='usuario_nuevo1.php' method='post' name='formu' class="row g-3 formulary" style="width: 500px;background-color: white; color: black;border: 2px solid black">
        <h5 style="text-align: center;border-bottom: 2px solid black; ">INSERTAR USUARIO<br><br></h5>
        <div class="col-12">
            <label class="form-label">Persona</label>
            <select class="form-select" aria-label="Default select example" name='id_persona'>
                <option selected>Seleccione</option>
                <?php foreach ($rs as $k => $fila) {?>
                <option value="<?php  echo$fila['id_persona']?>"><?php echo$fila['persona']?></option>
                <?php }?>
            </select>
            <p name='tci'></p>
        </div>
        <div class="col-md-6">
            <label class="form-label">Usuario</label>
            <input type="text" name='usuario' class="form-control" id="">
            <p name='tusuario'></p>
        </div>
        <div class="col-md-6">
            <label class="form-label">Contraseña</label>
            <input type="password" name='clave' class="form-control" id="">
            <p name='tclave'></p>
        </div>
        <div class="col-12" style="text-align: center;">
            <label class="form-label">(*) DATOS OBLIGATORIOS</label>
        </div>
        <div class="col-12" style="display: flex; justify-content: center; margin-bottom: 10px;">
            <input onclick="ValidarUsuario()"; value="ACEPTAR" type="button" class="btn btn-primary" style="margin-right: 10px; width: 150px;">
            <button onclick="location.href='usuarios.php'" type="reset" class="btn btn-danger" style="margin-left: 10px; width: 150px;">CANCELAR</button>
        </div>
    </form>
    <script src="../../js/bootstrap.bundle.min.js"></script>
    <script type='text/javascript' src='../js/validacion.js'></script>
</div>
<?php include("../../footer.php"); ?>