<?php
session_start();
require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");
//$db->debug=true;

$persona = strip_tags(stripslashes($_POST["persona"]));
$usuario = strip_tags(stripslashes($_POST["usuario"]));

if ($persona or $usuario) {
  $sql3 = $db->Prepare(" SELECT p.nombres as persona,u.*
                                  FROM personas p
                                  INNER JOIN usuarios u ON p.id_persona=u.id_persona
                                  WHERE      p.nombres LIKE ?
                                  AND        u.usuario LIKE ?
                                  AND        p.estado <> 'X' 
                                  AND        u.estado <> 'X'               
                              ");
  $rs3 = $db->GetAll($sql3, array($persona . "%", $usuario . "%"));
  if ($rs3) { ?>
    <div class="d-flex justify-content-center">
      <div class="table-responsive">
        <table class="table table-bordered border-dark">
          <thead class="table-active" style="text-align: center;">
            <tr>
              <th scope="col">PERSONA</th>
              <th scope="col">USUARIO</th>
              <th scope="col">ACCIONES</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <?php
              foreach ($rs3 as $k => $fila) {
                $str = $fila["persona"];
                $str1 = $fila["usuario"];
              ?>
                <td><?php echo resaltar($persona, $str) ?></td>
                <td><?php echo resaltar($usuario, $str1) ?></td>
                <td>
                  <div style="display: flex; justify-content: space-between;">
                    <form action="usuario_modificar.php" name="formuModif<?php echo $fila["id_usuario"]; ?>" method="post" style="padding-right: 5px;">
                      <input type="hidden" name="id_usuario" value="<?php echo $fila['id_usuario'] ?>">
                      <a class="btn btn-info" href="javascript:document.forms['<?php echo $fila["id_usuario"]; ?>'].submit();" title="Modificar">MODIDICAR</a>
                    </form>
                    <form action="usuario_eliminar.php" name="formElimi<?php echo $fila["id_usuario"]; ?>" method="post">
                      <input type="hidden" name="id_usuario" value="<?php echo $fila['id_usuario'] ?>">
                      <a class="btn btn-danger" href="javascript:if(confirm('¿Desea realmente eliminar al usuario<?php echo $fila['id_usuario'] ?>')){ document.forms['<?php echo $fila['id_usuario'] ?>'].submit(); }" title="Eliminar">ELIMINAR</a>
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