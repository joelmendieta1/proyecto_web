<?php 
session_start();
require_once("../../conexion.php");
require_once("../../header.php");
?>

<html>

<head>
  <link href='../../css/bootstrap.min.css' rel='stylesheet' />
</head>

<body>
  <br>
  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h2 class="header m-auto ">INSERTAR CATEGORÍA DE SERVICIO</h2>
    </div>
    <div class="container">
      <form class="row g-3 justify-content-center needs-validation" action="categoria_nuevo1.php" method="post" novalidate>
        
        <!-- Nombre -->
        <div class="col-auto" style="text-align: center;">
          <label class="form-label">(*)Nombre de la Categoría</label>
          <input type="text" class="form-control" name="nombre" id="validationOnlyLetters" pattern="[A-Za-z ]+" required>
          <div class="valid-feedback">
            Correcto
          </div>
          <div class="invalid-feedback">
            El nombre está vacío o es incorrecto.
          </div>
        </div>

        <!-- Botones -->
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
