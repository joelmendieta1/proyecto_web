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
<div class="card">
    <div class="container">
        <div class="row " >
            <div class="col">
                <a name="" id="" class="btn btn-danger" href="./reportes1.php" role="button" style="margin: 5px; padding: 10%;">REPORTES PARAMETRIZADOS</a>
            </div>
            <div class="col">
                <a name="" id="" class="btn btn-warning" href="./reportes2.php" role="button" style="margin: 5px; padding: 10%;">REPORTES ESTADISTICOS</a>
            </div>
        </div>
    </div>
</div>


<script src="../../js/bootstrap.bundle.min.js"></script>
<?php require_once("../../footer.php"); ?>