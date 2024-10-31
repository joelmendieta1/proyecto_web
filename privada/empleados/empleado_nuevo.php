<?php 
session_start();
require_once("../../conexion.php");
require_once("../../header.php");

// Aquí podrías cargar información adicional desde la base de datos si es necesario.
// Ejemplo: Cargar roles o departamentos.
?>

<html>

<head>
  <link href='../../css/bootstrap.min.css' rel='stylesheet' />
  <script type='text/javascript' src='../../ajax.js'></script>
  <script type="text/javascript">
    function validarApellidos() {
      // Obtener los valores de los apellidos
      var apellidoPaterno = document.getElementById("apellidoPaterno").value.trim();
      var apellidoMaterno = document.getElementById("apellidoMaterno").value.trim();

      // Verificar si ambos campos están vacíos
      if (apellidoPaterno === "" && apellidoMaterno === "") {
        alert("Debe ingresar al menos uno de los apellidos: paterno o materno.");
        return false; // Detener el envío del formulario
      }

      return true; // Si al menos uno está lleno, permitir el envío del formulario
    }
  </script>
</head>

<body>
  <br>
  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h2 class="header m-auto ">INSERTAR EMPLEADO</h2>
    </div>
    <div class="container">
      <form class="row g-3 justify-content-center needs-validation" action="empleado_nuevo1.php" method="post" name="formu" onsubmit="return validarApellidos()" novalidate>
        <!-- Cédula de Identidad -->
        <div class="col-auto" style="text-align: center;">
          <label class="form-label">(*)Cédula de Identidad</label>
          <input type="number" class="form-control" name="ci" id="validationOnlyNumbers" required>
          <div class="valid-feedback">
            Correcto
          </div>
          <div class="invalid-feedback">
            El CI está vacío o es incorrecto.
          </div>
        </div>

        <!-- Nombre -->
        <div class="col-auto " style="text-align: center;">
          <label class="form-label">(*)Nombre</label>
          <input type="text" class="form-control" name="nombre" id="validationOnlyLetters" pattern="[A-Za-z]+" required>
          <div class="valid-feedback">
            Correcto
          </div>
          <div class="invalid-feedback">
            El nombre está vacío o es incorrecto.
          </div>
        </div>

        <!-- Apellido Paterno -->
        <div class="col-auto " style="text-align: center;">
          <label class="form-label">Apellido Paterno</label>
          <input type="text" class="form-control" name="ap" id="apellidoPaterno" pattern="[A-Za-z]+">
          <div class="valid-feedback">
            Correcto
          </div>
          <div class="invalid-feedback">
            El apellido paterno es incorrecto.
          </div>
        </div>  

        <!-- Apellido Materno -->
        <div class="col-auto" style="text-align: center;">
          <label class="form-label">Apellido Materno</label>
          <input type="text" class="form-control" name="am" id="apellidoMaterno" pattern="[A-Za-z]+">
          <div class="valid-feedback">
            Correcto
          </div>
          <div class="invalid-feedback">
            El apellido materno es incorrecto.
          </div>
        </div>

        <!-- Teléfono -->
        <div class="col-auto" style="text-align: center;">
          <label class="form-label">(*)Teléfono</label>
          <input type="number" class="form-control" name="telefono" id="validationOnlyNumbers" required>
          <div class="valid-feedback">
            Correcto
          </div>
          <div class="invalid-feedback">
            El teléfono está vacío o es incorrecto.
          </div>
        </div>

        <!-- Fecha Inicio -->
        <div class="col-auto" style="text-align: center;">
          <label class="form-label">(*)Fecha de Inicio</label>
          <input type="date" class="form-control" name="fecha_inicio" id="validationAnyData" required>
          <div class="valid-feedback">
            Correcto
          </div>
          <div class="invalid-feedback">
            La fecha de inicio es obligatoria.
          </div>
        </div>

        <!-- Fecha Fin (Opcional) -->
        <div class="col-auto" style="text-align: center;">
          <label class="form-label">Fecha de Fin</label>
          <input type="date" class="form-control" name="fecha_fin" >
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
