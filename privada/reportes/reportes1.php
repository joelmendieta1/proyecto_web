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
            <input class="form-check-input" type="radio" name="reporte" id="reporte1" onclick="mostrarCuadro('cuadro1')">
            <label class="form-check-label" for="reporte1">REPORTE DE HISTORIAL DE FECHA A FECHA DE CLIENTES, EMPLEADOS, SERVICIOS Y CITAS</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="reporte" id="reporte2" onclick="mostrarCuadro('cuadro2')">
            <label class="form-check-label" for="reporte2">REPORTE ECONOMICO MENSUAL</label>
        </div>
    </div>
</div>
<br>
<div class="card">
    <div class="container">
        <div id="cuadro1" style="display: none;">
            <br>
            <h4>REPORTE DE HISTORIAL DE FECHA A FECHA DE CLIENTES, EMPLEADOS, SERVICIOS Y CITAS</h4>
            <form class="row g-3 justify-content-center needs-validation" method="post" name="formu" novalidate>
                <div class="col-auto" style="text-align: center;">
                    <label class="form-label">FECHA INICIO</label>
                    <input type="date" class="form-control" name='date1' id="validationAnyData" required>
                </div>
                <div class="col-auto" style="text-align: center;">
                    <label class="form-label">FECHA FIN</label>
                    <input type="date" class="form-control" name='date2' id="validationAnyData" required>
                </div>
                <div class="container row g-3">
                    <div class="col-auto m-auto">
                        <input type='hidden' name='accion' value=''>
                        <input type='button' value='Aceptar' onClick='validar();'>
                    </div>
                </div>
            </form>
        </div>
        <div id="cuadro2" style="display: none;">
            <h1>Cuadro 2</h1>
        </div>
    </div>
    <br>
</div>

<script src="../../js/bootstrap.bundle.min.js"></script>
<script>
    function mostrarCuadro(cuadro) {
        // Ocultar ambos cuadros
        document.getElementById('cuadro1').style.display = 'none';
        document.getElementById('cuadro2').style.display = 'none';

        // Mostrar el cuadro seleccionado
        document.getElementById(cuadro).style.display = 'block';
    }
</script>
<script type='text/javascript'>
    function validar() {
        fecha1 = document.formu.date1.value;
        fecha2 = document.formu.date2.value;
        if ((document.formu.date1.value == '') || (document.formu.date2.value == '') || (document.formu.date1.value > document.formu.date2.value)) {
            alert('Las fechas son incorrectas');
            document.formu.date1.focus();
            return;
        }
        ventanaCalendario = window.open('rpt1.php?fecha1=' + fecha1 + '&fecha2=' + fecha2, 'calendario', 'width=600, height=550,left=100,top=100,scrollbars=yes,menubars=no,statusbar=NO,status=NO,resizable=YES,location=NO')
    }
</script>

<?php require_once("../../footer.php"); ?>