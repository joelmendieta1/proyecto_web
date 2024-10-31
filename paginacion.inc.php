<?php
//session_start();

//$nElem = ((int)$_SESSION["sesion_valor"]);
$nElem = 4; /*Cantidad de registros*/
$nBotones = 3;  /*Cantidad de secciones*/
$posBoton = 1; /*Que los numeros de la paginacion vayan de  1 en 1*/

function paginacion($vinc)
{
  global $nElem;
  global $nPags;
  global $pag;
  global $posBoton;
  global $nBotones;
  global $paginas;
  global $urlnext;
  global $urlback;

  if (isset($_GET["posBoton"])) {
    $posBoton = $_GET["posBoton"];
  }
  if ($pag == $posBoton) {
    $posBoton = ($pag == 1) ? $posBoton : $posBoton - 1;
  }
  if ($pag == ($posBoton + $nBotones - 1)) {
    $posBoton = (($posBoton + $nBotones - 1) == $nPags) ? $posBoton : $posBoton + 1;
  }
  if ($nPags > 1) {
    $paginas = array();
    for ($i = $posBoton; $i < $pag; $i++) {
      $paginas[$i]["npag"] = $i;
      $paginas[$i]["pagV"] = "{$vinc}pag = $i";
    }
    $paginas[$pag]["npag"] = $pag;

    if ($pag <> 1) {
      $i = $pag - 1;
      $urlback = "{$vinc}pag=$i&posBoton=$posBoton";
    }
    for ($i = $posBoton; $i < $posBoton + $nBotones && $i <= $nPags; $i++) {
      $paginas[$i]["npag"] = $i;
      $paginas[$i]["pagV"] = "{$vinc}pag=$i&posBoton=$posBoton";
    }
    if ($pag < $nPags) {
      $i = $pag + 1;
      $urlnext = "{$vinc}pag=$i&posBoton=$posBoton";
    }
  }
}

//$pag = $_GET["pag"];
isset($_GET["pag"]) ? $pag = $_GET["pag"] : $pag = "";

function contarRegistros($db, $tabla)
{
  global $nElem;
  global $nPags;
  global $pag;
  global $regIni;
  if (!empty($tabla)) {
    $sqla = $db->Prepare("SELECT *
                             FROM INFORMATION_SCHEMA.COLUMNS
                             WHERE TABLE_SCHEMA='peluqueria_ahicito' 
                             AND COLUMN_NAME = 'estado' AND TABLE_NAME = '$tabla'
                             ");
    $rsa = $db->GetAll($sqla);

    if ($rsa) {
      $sql = $db->Prepare("SELECT count(*) as num 
					  FROM " . "$tabla" . " 
					  WHERE estado <> 'X'
                    ");
      $rs = $db->GetAll($sql);
    } else {
      $sql = $db->Prepare("SELECT count(*) as num 
					  FROM " . "$tabla" . " 
					  
                    ");
      $rs = $db->GetAll($sql);
    }
    if ($rs) {
      $total =  $rs[0]["num"];

      $nPags = ceil((float)$total / (float)$nElem);
      if (empty($pag))
        $pag = 1;
      elseif ($pag > $nPags)
        $pag = $nPags;
      $regIni = ($pag - 1) * $nElem;
      return $regIni;
    } else {
      return $regIni = 0;
    }
  } else
    return $regIni = 0;
}
function paginacion1()
{
  global $nElem;
  global $nPags;
  global $pag;
  global $posBoton;
  global $nBotones;
  global $paginas;
  global $urlnext;
  global $urlback;
?>

  <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-end">
      <li class="page-item <?php echo empty($urlback) ? 'disabled' : ''; ?>">
        <?php if (!empty($urlback)) { ?>
          <a href="<?php echo $urlback ?>" class="page-link" tabindex="-1" aria-disabled="true">Anterior</a>
        <?php } ?>
      </li>
      <?php if (!empty($paginas)) {
        foreach ($paginas as $k => $pagg) {
          if ($pagg["npag"] == $pag) { ?>
            <li class="page-item active">
              <span class="page-link"><?php echo $pagg["npag"]; ?></span>
            </li>
          <?php } else { ?>
            <li class="page-item">
              <a href="<?php echo $pagg["pagV"]; ?>" class="page-link"><?php echo $pagg["npag"]; ?></a>
            </li>
          <?php }
        }
      } ?> 
      <li class="page-item <?php echo ($nPags > $nBotones && !empty($urlnext) && $pag < $nPags) ? '' : 'disabled'; ?>">
        <?php if (($nPags > $nBotones) && !empty($urlnext) && ($pag < $nPags)) { ?>
          <a class="page-link" href="<?php echo $urlnext; ?>">Siguiente</a>
        <?php } ?>
      </li>
    </ul>
  </nav>

<?php
}

?>