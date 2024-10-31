<?php
session_start();

require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");

$id_cliente = $_POST["id_cliente"];

// Obtener datos del cliente
$sql3 = $db->Prepare("SELECT *
                      FROM clientes
                      WHERE id_cliente = ?
                      AND estado <> 'X'
                     ");
$rs3 = $db->GetAll($sql3, array($id_cliente)); 
?>
<div class="d-flex justify-content-between align-items-center">
  <h5 class="header m-auto ">DATOS DEL CLIENTE SELECCIONADO</h5>
</div>
<div class="d-flex justify-content-center">
  <div class="table-responsive">
    <table class="table table-bordered border-dark">
      <thead class="table-active" style="text-align: center;">
        <tr>
          <th scope="col">NOMBRE</th>
          <th scope="col">APELLIDO</th>
          <th scope="col">TELEFONO</th>
          <th scope="col">GENERO</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($rs3 as $k => $fila) { ?>
          <tr>
            <td><?php echo $fila["nombre"] ?></td>
            <td><?php echo $fila["apellido"] ?></td>
            <td><?php echo $fila["telefono"] ?></td>
            <td><?php echo $fila["genero"] ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>

<?php 
// Obtener citas del cliente
$sql4 = $db->Prepare("SELECT *
                      FROM citas
                      WHERE id_cliente = ?
                      AND estado <> 'X'
                     ");
$rs4 = $db->GetAll($sql4, array($id_cliente)); 
?>
<div class="d-flex justify-content-between align-items-center">
  <h5 class="header m-auto ">CITAS DEL CLIENTE</h5>
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
            <td colspan="4">NO TIENE CITAS REGISTRADAS</td>
          </tr>
        </tbody>
      <?php } ?>
    </table>
  </div>
</div>