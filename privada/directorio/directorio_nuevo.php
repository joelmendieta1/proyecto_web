<?php
session_start();
require_once("../../conexion.php");
require_once("../../header.php");
?>
<html>

<head>
    <link href='../../css/bootstrap.min.css' rel='stylesheet' />
    <script type='text/javascript' src='../../ajax.js'></script>
    <script type='text/javascript' src='./js/validar.js'></script>
    <script type='text/javascript' src='./js/buscar.js'></script>
    <script type='text/javascript' src='../js/expresiones_regulares.js'></script>
</head>

<body>
    <br>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2 class="header m-auto ">INSERTAR DIRECTORIO</h2>
        </div>
        <div class="container">
            <form class="row g-3 justify-content-center" action="directorio_nuevo1.php" method="post" name="formu">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="header m-auto ">TERAPEUTA</h4>
                </div>
                <div class="col-auto" style="text-align: center;">
                    <label class="form-label">Nombres</label>
                    <input type="text" class="form-control" name="nombres" onkeyup="buscar()">
                </div>
                <div class="col-auto" style="text-align: center;">
                    <label class="form-label">Apellidos</label>
                    <input type="text" class="form-control" name="apellidos" onkeyup="buscar()">
                </div>
                <div class="col-auto" style="text-align: center;">
                    <label class="form-label">Cedula</label>
                    <input type="text" class="form-control" name="ci" onkeyup="buscar()">
                </div>
                <div class="col-auto" style="text-align: center;">
                    <label class="form-label">Profesion</label>
                    <input type="text" class="form-control" name="profesion" onkeyup="buscar()">
                </div>
                <div>
                    <div id="terapeuta"></div>
                </div>
                <div>
                    <div id="terapeuta_selecionada"></div>
                </div>
                <div>
                    <input type="hidden" name="id_terapeuta">
                    <div id="terapeuta_insertada"></div>
                </div>
                <div class="col-auto" style="text-align: center;">
                    <label class="form-label">(*)Cargos</label>
                    <input type="text" class="form-control" name="cargos" id="cargos">
                </div>
                <div class="col-auto"  style="text-align: center;">
                    <label class="form-label">(*)Fecha Inicio</label>
                    <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio">
                </div>
                <div class="col-auto" style="text-align: center;">
                    <label class="form-label">(*)Fecha Final</label>
                    <input type="date" class="form-control" name="fecha_final" id="fecha_final">
                </div>
                <div class="container" style="text-align: center; padding-top: 20px;">
                    <button type="button" class="btn btn-primary" onclick="validar()">ACEPTAR</button>
                    <button type="reset" class="btn btn-secondary">BORRAR</button>
                    <br>(*)Datos Obligatorios
                </div>
            </form>
        </div>
    </div>
    <script src='../../js/bootstrap.bundle.min.js'></script>
</body>

</html>