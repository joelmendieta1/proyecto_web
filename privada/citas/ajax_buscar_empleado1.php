<?php
session_start();

require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");

$id_empleado = $_POST["id_empleado"];

// Obtener datos del empleado
$sql3 = $db->Prepare("SELECT *
                      FROM empleados
                      WHERE id_empleado = ?
                      AND estado <> 'X'
                     ");
$rs3 = $db->GetAll($sql3, array($id_empleado)); 
?>
<div class="d-flex justify-content-between align-items-center">
  <h5 class="header m-auto ">DATOS DEL EMPLEADO SELECCIONADO</h5>
</div>
<div class="d-flex justify-content-center">
  <div class="table-responsive">
    <table class="table table-bordered border-dark">
      <thead class="table-active" style="text-align: center;">
        <tr>
          <th scope="col">NOMBRE</th>
          <th scope="col">APELLIDO PATERNO</th>
          <th scope="col">APELLIDO MATERNO</th>
          <th scope="col">TELEFONO</th>
          <th scope="col">CI</th>
          <th scope="col">FECHA INICIO</th>
          <th scope="col">FECHA FIN</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($rs3 as $k => $fila) { ?>
          <tr>
            <td><?php echo $fila["nombre"] ?></td>
            <td><?php echo $fila["ap"] ?></td>
            <td><?php echo $fila["am"] ?></td>
            <td><?php echo $fila["telefono"] ?></td>
            <td><?php echo $fila["ci"] ?></td>
            <td><?php echo $fila["fecha_inicio"] ?></td>
            <td><?php echo $fila["fecha_fin"]  ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>

<?php 
// Obtener citas del empleado
$sql4 = $db->Prepare("SELECT *
                      FROM citas
                      WHERE id_empleado = ?
                      AND estado <> 'X'
                     ");
$rs4 = $db->GetAll($sql4, array($id_empleado)); 
?>
<div class="d-flex justify-content-between align-items-center">
  <h5 class="header m-auto ">CITAS DEL EMPLEADO</h5>
</div>
<div class="d-flex justify-content-center">
  <div class="table-responsive">
    <table class="table table-bordered border-dark">
      <thead class="table-active" style="text-align: center;">
        <tr>
          <th scope="col">FECHA</th>
          <th scope="col">HORA</th>
        </tr>
      </thead>
      <?php 
      if ($rs4) { ?>
        <tbody>
        <?php foreach ($rs4 as $k => $fila) { ?>
          <tr>
            <td><?php echo $fila["fecha"] ?></td>
            <td><?php echo $fila["hora"] ?></td>
          </tr>
        <?php } ?>
        </tbody>
      <?php } else { ?>
        <tbody style="text-align: center;">
          <tr>
            <td colspan="2">NO TIENE CITAS REGISTRADAS</td>
          </tr>
        </tbody>
      <?php } ?>
    </table>
  </div>
</div>

