<?php
// Iniciar sesión

require_once("adodb/adodb.inc.php");
require_once("conexion.php");
if (isset($_SESSION["sesion_id_rol"])) {

    $sql1 = $db->Prepare("SELECT nombre, logo
                          FROM peluqueria
                          WHERE id_peluqueria = 1
                          AND estado <> 'X'");
    $rs1 = $db->GetAll($sql1);
    $nombre = $rs1[0]["nombre"];
    $logo = $rs1[0]["logo"];

    $dir_php = $_SERVER["PHP_SELF"];
    $cuerp = strpos($dir_php, "principal.php");



    $sql = $db->Prepare("SELECT ac.*, op.id_opcion, op.orden, op.contenido, gr.id_grupo, gr.grupo, op.opcion 
                         FROM accesos ac
                         INNER JOIN opciones op ON ac.id_opcion = op.id_opcion
                         INNER JOIN grupos gr ON op.id_grupo = gr.id_grupo
                         WHERE ac.id_rol = '" . $_SESSION["sesion_id_rol"] . "'
                         AND ac.estado <> 'X'
                         AND op.estado <> 'X'
                         AND gr.estado <> 'X'
                         ORDER BY op.id_grupo, op.orden");
    $rs = $db->Execute($sql);

    $nick = $_SESSION["sesion_usuario"];
} else {
    $rs = "";
    $nick = "";
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->

    <link href="./css/bootstrap.min.css" rel="stylesheet" />


</head>

<body class="p-3 mb-2 bg-success text-white">
    <div class="container">
        <div class="row justify-content-md-center">
            <?php if (isset($_SESSION["sesion_id_rol"])) { ?>
                <div class="col">
                    <?php
                    if ($cuerp == false) {
                        echo "<img src='../peluqueria/logos/{$logo}' style='width: 150px; height: 150px;' >";
                    } else {
                        echo " <img src='privada/peluqueria/logos/{$logo}' class='img-fluid' >";
                    }
                    ?>
                </div>
                <div class="col-md-auto">
                    <h2>SISTEMA WEB <?= htmlspecialchars($nombre) ?></h2>
                </div>
                <div class="col">
                    USUARIO: <?= htmlspecialchars($_SESSION["sesion_usuario"]) ?>
                    <div style="padding-top: 5px;"></div>
                    ROL: <?= htmlspecialchars($_SESSION["sesion_rol"]) ?>
                </div>
            <?php } else { ?>

            <?php } ?>
            <div class="col col-lg-2">
                <?php
                if ($cuerp == false) {
                    echo '<button type="button" class="btn btn-danger" onclick="location.href=\'../../validar.php\'" name="accion" value="Cerrar Sesion">Cerrar Sesión</button>';
                } else {
                    echo '<button type="button" class="btn btn-danger" onclick="location.href=\'validar.php\'" name="accion" value="Cerrar Sesion">Cerrar Sesión</button>';
                }
                ?>
                <div style="padding-top: 5px;"></div>
                <div class="btn btn-light">
                    VISITAS: <?php echo isset($_SESSION['contador']) ? htmlspecialchars($_SESSION['contador']) : '0'; ?>
                </div>
            </div>
        </div>
    </div>
    <br>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    <p>MENU</p>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <?php
                        if ($nick != "") {
                            $grup = "";
                            foreach ($rs as $r => $fila) {
                                if ($grup != $fila["grupo"]) {
                                    if ($grup != "") {
                                        echo "</ul></li>";
                                    }
                                    echo "<li class='nav-item dropdown'>
                                            <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown_{$r}' role='button' data-bs-toggle='dropdown' aria-expanded='false'>{$fila["grupo"]}</a>
                                            <ul class='dropdown-menu' aria-labelledby='navbarDropdown_{$r}'>";
                                    $grup = $fila["grupo"];
                                }
                                $link = $cuerp === false || $cuerp === "" ? "../{$fila["contenido"]}" : "sis_segundo_2022/{$fila["contenido"]}";
                                echo "<li><a class='dropdown-item' href='{$link}'>{$fila["opcion"]}</a></li>";
                            }
                            if ($grup != "") {
                                echo "</ul></li>";
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main>