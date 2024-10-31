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

<div class="card" id="id=prpietarios1">
    <div class="card-header d-flex justify-content-between align-items-center">
        <a href="propietario_nuevo.php" class="btn btn-primary">Añadir Propietario</a>
        <h4>Listado de Propietarios</h4>
        <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">BUSCAR</button>
        </form>
    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <?php
            contarRegistros($db,"propietario");
            paginacion("propietario.php?");
            $sql = $db->Prepare("SELECT *
FROM propietario
WHERE estado <> 'X' 
ORDER BY id_propietario DESC
LIMIT ? OFFSET ?                        
    ");
            $rs = $db->GetAll($sql,array($nElem,$regIni));
            if ($rs) { ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">NUMERO</th>
                            <th scope="col">APELLIDOS</th>
                            <th scope="col">NOMBRES</th>
                            <th scope="col">TELEFONO</th>
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
                                <td><?php echo $fila["apellido"]; ?></td>
                                <td><?php echo $fila["nombre"]; ?></td>
                                <td><?php echo $fila["telefono"]; ?></td>
                                <td>
                                    <a class="btn btn-info" role="button" href="#" onclick="modificarPropietario(<?php echo $fila['id_propietario']; ?>)">Modificar</a>
                                    <a class="btn btn-danger" role="button" href="#"
                                        data-id-propietario="<?php echo $fila['id_propietario']; ?>"
                                        data-nombre="<?php echo $fila['nombre']; ?>"
                                        data-apellido="<?php echo $fila['apellido']; ?>"
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
    function modificarPropietario(idPropietario) {
        const form = document.createElement('form');
        form.method = 'post';
        form.action = 'propietario_modificar.php';

        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'id_propietario';
        input.value = idPropietario;

        form.appendChild(input);
        document.body.appendChild(form);
        form.submit();
    }

    function eliminarPropietario(idPropietario, nombre, apellido) {

        const form = document.createElement('form');
        form.method = 'post';
        form.action = 'propietario_eliminar.php';

        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'id_propietario';
        input.value = idPropietario;

        form.appendChild(input);
        document.body.appendChild(form);
        form.submit();
    }

    function mostrarMensaje(button) {
        var contenedorMensajes = document.getElementById('contenedor-mensajes');
        contenedorMensajes.innerHTML = '';
        var idPropietario = button.getAttribute('data-id-propietario');
        var nombre = button.getAttribute('data-nombre');
        var apellido = button.getAttribute('data-apellido');

        var mensajeDiv = document.createElement('div');
        mensajeDiv.className = 'row';
        mensajeDiv.style.marginBottom = '20px';
        mensajeDiv.style.border = '1px solid #ddd';
        mensajeDiv.style.padding = '15px';
        mensajeDiv.style.borderRadius = '10px';

        var mensajeHTML = `
        <div class="col-lg-12">
            <h4>¿Estás seguro de que quieres eliminar al propietario?</h4>
            <p><strong>${nombre} ${apellido}</strong></p>
            <a class="btn btn-danger" role="button" href="#" onclick="eliminarYOcultar(${idPropietario}, '${nombre}', '${apellido}', this)">
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

    function eliminarYOcultar(idPropietario, nombre, apellido,button) {
        eliminarPersona(idPropietario, nombre, apellido);
        cancelarMensaje(button);
    }

    function cancelarMensaje(button) {
        var mensajeDiv = button.closest('.row');
        mensajeDiv.remove();
    }

    function aceptarMensaje() {

        var contenedorMensajes = document.getElementById('contenedor-mensajes');
        contenedorMensajes.innerHTML = '';
        window.location.href = 'propietario.php';
    }
</script>
<?php include("../../footer.php"); ?>