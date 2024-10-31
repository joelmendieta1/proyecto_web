<?php
session_start();
require_once("../../conexion.php");
require_once("../../header.php");

$sql = $db->Prepare(" SELECT  *
                    FROM    tipos_clientes 
                    WHERE   estado='A'
                    ");
$rs = $db->GetAll($sql);
?>
<html>

<head>
  <link href='../../css/bootstrap.min.css' rel='stylesheet' />
  <script type='text/javascript' src='../../ajax.js'></script>
  <script type='text/javascript' src='./js/buscar.js'></script>
</head>

<body>
  <br>
  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h2 class="header m-auto ">INSERTAR CLIENTE</h2>
    </div>
    <div class="container">
      <form class="row g-3 justify-content-center needs-validation" action="cliente_nuevo1.php" method="post" name="formu" novalidate>
        <div class="container row g-3">
          <div class="d-flex justify-content-between align-items-center">
            <h4 class="header m-auto ">TIPO DE CLIENTE</h4>
          </div>
          <div class="col-auto m-auto">
            <label class="form-label">(*)SELECIONE UN TIPO DE CLIENTE</label>
            <select class="form-select" aria-label="Default select example" name="tipo" id="validationAnyData" required>
              <option value=""></option>
              <?php foreach ($rs as $fila) { ?>
                <option value="<?php echo $fila['id_tipo_cliente'] ?>"> <?php echo $fila['nombre'] ?> </option>';
              <?php } ?>
            </select>
            </select>
            <div class="valid-feedback">
              Correcto
            </div>
            <div class="invalid-feedback">
              Selecionar
            </div>
          </div>
        </div>
        <div class="col-auto " style="text-align: center;">
          <label class="form-label">(*)Nombre</label>
          <input type="text" class="form-control" name="nombre" id="validationOnlyLetters" pattern="[A-Za-z]+" required>
          <div class="valid-feedback">
            Correcto
          </div>
          <div class="invalid-feedback">
            El nombre esta vacio o Incorecto
          </div>
        </div>
        <div class="col-auto" style="text-align: center;">
          <label class="form-label">(*)Apellido</label>
          <input type="text" class="form-control" name="apellido" id="validationOnlyLetters" pattern="[A-Z a-z]+" required>
          <div class="valid-feedback">
            Correcto
          </div>
          <div class="invalid-feedback">
            El apellido esta vacio o Incorecto
          </div>
        </div>
        <div class="col-auto" style="text-align: center;">
          <label class="form-label">(*)Telefono</label>
          <input type="number" class="form-control" name="telefono" id="validationOnlyNumbers" required>
          <div class="valid-feedback">
            Correcto
          </div>
          <div class="invalid-feedback">
            El telefono esta vacio o Incorecto
          </div>
        </div>
        <div class="col-auto">
          <label class="form-label">(*)GENERO</label>
          <select class="form-select" aria-label="Default select example" name="genero" id="validationAnyData" required>
            <option value=""></option>
            <option value="M">Masculino</option>
            <option value="F">Femenino</option>
          </select>
          </select>
          <div class="valid-feedback">
            Correcto
          </div>
          <div class="invalid-feedback">
            Selecionar
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