<?php
session_start();
require_once("../../conexion.php");
require_once("../../header.php");

$sql = $db->Prepare(" SELECT  CONCAT_WS(' ', nombre, apellido) AS cliente
                    FROM    clientes 
                    WHERE   estado='A'
                    ");
$rs = $db->GetAll($sql);
$sql1 = $db->Prepare(" SELECT  CONCAT_WS(' ', nombre,ap,am) AS empleado, id_empleado
                    FROM    empleados 
                    WHERE   estado='A'
                    ");
$rs1 = $db->GetAll($sql1);
?>
<html>

<head>
  <link href='../../css/bootstrap.min.css' rel='stylesheet' />
  <script type='text/javascript' src='../../ajax.js'></script>
  <script type='text/javascript' src='./js/buscar_cliente.js'></script>
  <script type='text/javascript' src='./js/buscar_empleado.js'></script>
</head>
<body>
  <br>
  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h2 class="header m-auto ">INSERTAR CITA</h2>
    </div>
    <div class="container">
      <form class="row g-3 justify-content-center needs-validation" action="citas_nuevo1.php" method="post" name="formu" novalidate>
        <div class="d-flex justify-content-between align-items-center">
          <h4 class="header m-auto ">CLIENTE</h4>
        </div>
        <div class="col-auto" style="text-align: center;">
          <select class="form-select" aria-label="Default select example" name="cliente" onchange="buscarC()" id="validationAnyData" required>
            <option value=""></option>
            <option value=".">AÑADIR CLIENTE</option>
            <?php foreach ($rs as $fila) { ?>
              <option value="<?php echo $fila['cliente'] ?>"> <?php echo $fila['cliente'] ?> </option>';
            <?php } ?>
          </select>
          <div class="valid-feedback">
            Correcto
          </div>
          <div class="invalid-feedback">
            asignar un Cliente
          </div>
        </div>
        <div>
          <div id="cliente"></div>
        </div>
        <div>
          <div id="cliente_selecionada"></div>
        </div>
        <div>
          <input type="hidden" name="id_cliente">
          <div id="cliente_insertada"></div>
        </div>
        <div class="d-flex justify-content-between align-items-center">
          <h4 class="header m-auto ">EMPLEADO</h4>
        </div>
        <div class="col-auto" style="text-align: center;">
          <select class="form-select" aria-label="Default select example" name="empleado" onchange="buscarE()" id="validationAnyData" required>
            <option value=""></option>';
            <option value=".">AÑADIR EMPLEADO</option>
            <?php foreach ($rs1 as $fila) { ?>
              <option value="<?php echo $fila['empleado'] ?>"> <?php echo $fila['empleado'] ?> </option>';
            <?php } ?>
          </select>
          <div class="valid-feedback">
            Correcto
          </div>
          <div class="invalid-feedback">
            asignar un Empleado
          </div>
        </div>
        <div>
          <div id="empleado"></div>
        </div>
        <div>
          <div id="empleado_selecionada"></div>
        </div>
        <div>
          <input type="hidden" name="id_empleado">
          <div id="empleado_insertada"></div>
        </div>
        <div class="col-auto" style="text-align: center;">
          <label class="form-label">(*)Fecha</label>
          <input type="date" class="form-control" name="fecha" id="validationAnyData" required>
          <div class="valid-feedback">
            Correcto
          </div>
          <div class="invalid-feedback">
            debe ingresar una fecha
          </div>
        </div>
        <div class="col-auto" style="text-align: center;">
          <label class="form-label">(*)Hora</label>
          <input type="time" class="form-control" name="hora" id="validationAnyData" required>
          <div class="valid-feedback">
            Correcto
          </div>
          <div class="invalid-feedback">
            Asignar la hora
          </div>
        </div>
        <div class="container" style="text-align: center; padding-top: 20px;">
          <button type="submit" class="btn btn-primary">ACEPTAR</button>
          <button type="reset" class="btn btn-secondary">BORRAR</button>
          <br>(*)Datos Obligatorios
        </div>
      </form>
    </div>
  </div>
  <script type='text/javascript' src='../js/validar.js'></script>
  <script src='../../js/bootstrap.bundle.min.js'></script>
</body>

</html>