<?php
session_start();

require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");

$id_terapeuta = $_POST["id_terapeuta"];

//$db->debug=true;
$sql3 = $db->Prepare("SELECT *
                      FROM terapeutas
                      WHERE id_terapeuta = ?
                      AND estado <> 'X'
                     ");
$rs3 = $db->GetAll($sql3, array($id_terapeuta)); ?>
<div class="d-flex justify-content-between align-items-center">
  <h5 class="header m-auto ">DATOS DEL TERAPEUTA SELECCIONADO</h5>
</div>
<div class="d-flex justify-content-center">
  <div class="table-responsive">
    <table class="table table-bordered border-dark">
      <thead class="table-active" style="text-align: center;">
        <tr>
          <th scope="col">NOMBRES</th>
          <th scope="col">APELLIDOS</th>
          <th scope="col">CEDULA</th>
          <th scope="col">DIRECCION</th>
          <th scope="col">TELEFONO</th>
          <th scope="col">PROFESION</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($rs3 as $k => $fila) { ?>
          <tr>
            <td><?php echo $fila["nombres"] ?></td>
            <td><?php echo $fila["apellidos"] ?></td>
            <td><?php echo $fila["ci"] ?></td>
            <td><?php echo $fila["direccion"] ?></td>
            <td><?php echo $fila["telefono"] ?></td>
            <td><?php echo $fila["profesion"] ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>

<?php $sql4 = $db->Prepare("SELECT *
                      FROM directorio
                      WHERE id_terapeuta = ?
                      AND estado <> 'X'
                     ");
$rs4 = $db->GetAll($sql4, array($id_terapeuta)); ?>
<div class="d-flex justify-content-between align-items-center">
  <h5 class="header m-auto ">DIRECTORIOS DEL TERAPEUTA</h5>
</div>
<div class="d-flex justify-content-center">
  <div class="table-responsive">
    <table class="table table-bordered border-dark">
      <thead class="table-active" style="text-align: center;">
        <tr>
          <th scope="col">CARGOS</th>
          <th scope="col">FECHA INICIO</th>
          <th scope="col">FECHA FIN</th>
        </tr>
      </thead>
      <?php 
      if ($rs4) { ?>
        <tbody>
        <?php foreach ($rs4 as $k => $fila) { ?>
          <tr>
            <td><?php echo $fila["cargos"] ?></td>
            <td><?php echo $fila["fecha_inicio"] ?></td>
            <td><?php echo $fila["fecha_final"] ?></td>
          </tr>
        <?php } ?>
        </tbody>
      <?php } else {?>
        <tbody style="text-align: center;">
          <tr>
            <td colspan="3">NO TIENE DIRECTORIOS</td>
          </tr>
      </tbody>
         </table>
  </div>
</div>
      <?php }?>