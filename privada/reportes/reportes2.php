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
?>
<link href="../../css/bootstrap.min.css" rel="stylesheet" />
<br>
<div class="card" style="background-color: gray;">
    <div class="container">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="" id="">
            <label class="form-check-label" for="">REPORTE DE LINEAS TIPOS DE CLIENTE Y SUS GENEROS</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="" id="">
            <label class="form-check-label" for="">REPORTE DE TORTA 3D SERVICIOS</label>
        </div>
    </div>
</div>
<script src="../../js/bootstrap.bundle.min.js"></script>
<?php require_once("../../footer.php"); ?>