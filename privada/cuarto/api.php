<?php
// Iniciar sesión
session_start();
require_once("../../conexion.php");
require_once("../../header.php");

if (!isset($_SESSION["sesion_id_rol"])) {
    header("Location: index.php");
    exit();
}
?>
<link href="../../css/bootstrap.min.css" rel="stylesheet" />
<br>
<div class="card" id="news">

</div>

<!-- Botón flotante -->
<button id="refreshButton" class="btn btn-primary" style="position: fixed; bottom: 20px; right: 20px; z-index: 1000;">
    Actualizar
</button>

<script src="https://cdn.jsdelivr.net/npm/axios@1.7.7/dist/axios.min.js"></script>
<script src="main.js"></script>

<script src="../../js/bootstrap.bundle.min.js"></script>
<script>
    // Función para actualizar la página
    document.getElementById('refreshButton').addEventListener('click', function() {
        location.reload();
    });
</script>

<?php require_once("../../footer.php"); ?>