<?php
// Iniciar sesión
session_start();
require_once("../../conexion.php");
require_once("../../paginacion.inc.php");

if (!isset($_SESSION["sesion_id_rol"])) {

    header("Location: index.php");
    exit();
}
$mensaje = "";
$mensaje_tipo = "";
if (isset($_SESSION['mensaje'])) {
    $mensaje = $_SESSION['mensaje'];
    $mensaje_tipo = $_SESSION['mensaje_tipo'];


    unset($_SESSION['mensaje']);
    unset($_SESSION['mensaje_tipo']);
}
?>
<?php include("../../header.php"); ?>
<link href="../../css/bootstrap.min.css" rel="stylesheet" />
<div id="contenedor-mensajes" class="container" style="max-width: 90%; margin: auto; padding: 20px;">
    <?php if ($mensaje): ?>
        <div class="alert alert-<?php echo $mensaje_tipo; ?>" role="alert">
            <?php echo $mensaje; ?>
            <?php if ($mensaje_tipo == "danger"): ?>
                <a class="btn btn-primary" href="#" role="button" onclick="aceptarMensaje()">Aceptar</a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>

<div class="card" id="id=usuarios1">
    <div class="card-header d-flex justify-content-between align-items-center">
        <a href="libro_nuevo.php" class="btn btn-primary">Añadir Libro</a>
        <h4>Listado de Libros</h4>
        <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">BUSCAR</button>
        </form>
    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <?php
            contarRegistros($db,"usuarios");
            paginacion("usuarios.php?");
            $sql = $db->Prepare("SELECT c.Categoria, l.* 
            FROM categorias c, libros l
            WHERE l.Categoria_id=c.id
            ORDER BY l.id DESC                      
               ");
$rs = $db->GetAll($sql);
            if ($rs) { ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">NUMERO</th>
                            <th scope="col">CATEGORIA</th>
                            <th scope="col">CODIGO</th>
                            <th scope="col">TITULO</th>
                            <th scope="col">NUMERO DE PAGINAS</th>
                            <th scope="col">EDITORIAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $b=0;
                                $total=$pag-1;
                                $a=$nElem*$total;
                                $b=$b+1+$a;
                        foreach ($rs as $k => $fila) {  ?>
                            <tr>
                                <td><?php echo $b ?></td>
                                <td><?php echo $fila["Categoria"]; ?></td>
                                <td><?php echo $fila["codigo"]; ?></td>
                                <td><?php echo $fila["titulo"]; ?></td>
                                <td><?php echo $fila["nro_paginas"]; ?></td>
                                <td><?php echo $fila["editorial"]; ?></td>
                            </tr>
                    </tbody>
                <?php
                            $b = $b + 1;
                        } ?>
                </table>
            <?php } ?>
        </div>
        <?php paginacion1(); ?>
    </div>
</div>
<script src="../../js/bootstrap.bundle.min.js"></script>
<?php include("../../footer.php"); ?>