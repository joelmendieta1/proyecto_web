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

<div class="card" id="id=tipos_clientes1">
    <div class="card-header d-flex justify-content-between align-items-center">
        <a href="tipo_nuevo.php" class="btn btn-primary">Añadir Tipo de Cliente</a>
        <h4 class="header">Listado de Tipos de Cliente</h4>
        <div class="card text-center">
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <?php
            contarRegistros($db,"tipos_clientes");
            paginacion("tipos_clientes.php?");
            $sql = $db->Prepare("SELECT *
FROM tipos_clientes
WHERE estado <> 'X' 
ORDER BY id_tipo_cliente DESC
LIMIT ? OFFSET ?                        
    ");
            $rs = $db->GetAll($sql,array($nElem,$regIni));
            if ($rs) { ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">NUMERO</th>
                            <th scope="col">NOMBRE</th>
                            <th scope="col">ACCIONES</th>
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
                                <td><?php echo $fila["nombre"]; ?></td>
                                <td>
                                    <a class="btn btn-info" role="button" href="#" onclick="modificarTipo(<?php echo $fila['id_tipo_cliente']; ?>)">Modificar</a>

                                    <a class="btn btn-danger" role="button" href="#"
                                        data-id-tipo-cliente="<?php echo $fila['id_tipo_cliente']; ?>"
                                        data-nombre="<?php echo $fila['nombre']; ?>"
                                        onclick="mostrarMensaje(this)">
                                        Eliminar
                                    </a>
                                </td>
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
<script>
    function modificarTipo(idTipo) {
        const form = document.createElement('form');
        form.method = 'post';
        form.action = 'tipo_modificar.php';

        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'id_tipo_cliente';
        input.value = idTipo;

        form.appendChild(input);
        document.body.appendChild(form);
        form.submit();
    }

    function eliminarTipo(idTipo, nombre) {

        const form = document.createElement('form');
        form.method = 'post';
        form.action = 'tipo_eliminar.php';

        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'id_tipo_cliente';
        input.value = idTipo;

        form.appendChild(input);
        document.body.appendChild(form);
        form.submit();
    }

    function mostrarMensaje(button) {
        var contenedorMensajes = document.getElementById('contenedor-mensajes');
        contenedorMensajes.innerHTML = '';
        var idTipo = button.getAttribute('data-id-tipo-cliente');
        var nombre = button.getAttribute('data-nombre');


        var mensajeDiv = document.createElement('div');
        mensajeDiv.className = 'row';
        mensajeDiv.style.marginBottom = '20px';
        mensajeDiv.style.border = '1px solid #ddd';
        mensajeDiv.style.padding = '15px';
        mensajeDiv.style.borderRadius = '10px';

        var mensajeHTML = `
        <div class="col-lg-12">
            <h4>¿Estás seguro de que quieres eliminar a al tipo de cliente?</h4>
            <p><strong>${nombre}</strong></p>
            <a class="btn btn-danger" role="button" href="#" onclick="eliminarYOcultar(${idTipo}, '${nombre}', this)">
                Eliminar
            </a>
            <a class="btn btn-secondary" role="button" href="#" onclick="cancelarMensaje(this)">
                Cancelar
            </a>
        </div>
    `;

        mensajeDiv.innerHTML = mensajeHTML;
        contenedorMensajes.appendChild(mensajeDiv);
    }

    function eliminarYOcultar(idTipo, nombre, button) {
        eliminarCategoria(idTipo, nombre);
        cancelarMensaje(button);
    }

    function cancelarMensaje(button) {
        var mensajeDiv = button.closest('.row');
        mensajeDiv.remove();
    }

    function aceptarMensaje() {

        var contenedorMensajes = document.getElementById('contenedor-mensajes');
        contenedorMensajes.innerHTML = '';
        window.location.href = 'tipos_clientes.php';
    }
</script>
<?php include("../../footer.php"); ?>