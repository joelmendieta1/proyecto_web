<?php
session_start();
require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");
//$db->debug=true;
$terapeuta = $_POST["terapeuta"] ?? '';
$cargos = strip_tags(stripslashes($_POST["cargos"]));
$fecha_inicio = strip_tags(stripslashes($_POST["fecha_inicio"]));

if ($terapeuta or $cargos or $fecha_inicio) {
  $sql3 = $db->Prepare(" SELECT t.nombres as terapeuta,d.*
                                  FROM terapeutas t
                                  INNER JOIN directorio d ON d.id_terapeuta=t.id_terapeuta
                                  WHERE      t.nombres LIKE ?
                                  AND        d.cargos LIKE ?
                                  AND        d.fecha_inicio LIKE ?
                                  AND        t.estado <> 'X' 
                                  AND        d.estado <> 'X'               
                              ");
  $rs3 = $db->GetAll($sql3, array($terapeuta . "%", $cargos . "%", $fecha_inicio . "%"));
  if ($rs3) { ?>
    <div class="d-flex justify-content-center">
      <div class="table-responsive">
        <table class="table table-bordered border-dark">
          <thead class="table-active" style="text-align: center;">
            <tr>
              <th scope="col">TERAPEUTA</th>
              <th scope="col">CARGOS</th>
              <th scope="col">FECHA INICIO</th>
              <th scope="col">ACCIONES</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <?php
              foreach ($rs3 as $k => $fila) {
                $str = $fila["terapeuta"];
                $str1 = $fila["cargos"];
                $str2 = $fila["fecha_inicio"];
              ?>
                <td><?php echo resaltar($terapeuta, $str) ?></td>
                <td><?php echo resaltar($cargos, $str1) ?></td>
                <td><?php echo resaltar($fecha_inicio, $str2) ?></td>
                <td>
                  <div style="display: flex; justify-content: space-between;">
                    <form action="usuario_modificar.php" name="formuModif<?php echo $fila["id_directorio"]; ?>" method="post" style="padding-right: 5px;">
                      <input type="hidden" name="id_directorio" value="<?php echo $fila['id_directorio'] ?>">
                      <a class="btn btn-info" href="javascript:document.forms['<?php echo $fila["id_directorio"]; ?>'].submit();" title="Modificar">MODIDICAR</a>
                    </form>
                    <form action="usuario_eliminar.php" name="formElimi<?php echo $fila["id_directorio"]; ?>" method="post">
                      <input type="hidden" name="id_directorio" value="<?php echo $fila['id_directorio'] ?>">
                      <a class="btn btn-danger" href="javascript:if(confirm('¿Desea realmente eliminar al usuario<?php echo $fila['id_directorio'] ?>')){ document.forms['<?php echo $fila['id_directorio'] ?>'].submit(); }" title="Eliminar">ELIMINAR</a>
                    </form>
                  </div>
                </td>
            </tr>
          <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  <?php
  } else { ?>
    <div class="d-flex justify-content-center">
      <h5>NO HAY DATOS</h5>
    </div>
<?php }
} ?>