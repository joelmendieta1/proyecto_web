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

<div class="card" id="id=personas1">
    <div class="card-header d-flex justify-content-between align-items-center">
        <a href="persona_nuevo.php" class="btn btn-primary">Añadir Persona</a>
        <h4 class="header">Listado de Personas</h4>
        <div class="card text-center">
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <?php
            contarRegistros($db, "personas");
            paginacion("personas.php?");
            $sql = $db->Prepare("SELECT *
FROM personas
WHERE estado <> 'X' 
ORDER BY id_persona DESC
LIMIT ? OFFSET ?                        
    ");
            $rs = $db->GetAll($sql, array($nElem, $regIni));
            if ($rs) { ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">NUMERO</th>
                            <th scope="col">APELLIDO PATERNO</th>
                            <th scope="col">APELLIDO MATERNO</th>
                            <th scope="col">NOMBRES</th>
                            <th scope="col">CEDULA</th>
                            <th scope="col">TELEFONO</th>
                            <th scope="col">DIRECCION</th>
                            <th scope="col">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $b = 0;
                        $total = $pag - 1;
                        $a = $nElem * $total;
                        $b = $b + 1 + $a;
                        foreach ($rs as $k => $fila) {  ?>
                            <tr>
                                <td><?php echo $b ?></td>
                                <td><?php echo $fila["ap"]; ?></td>
                                <td><?php echo $fila["am"]; ?></td>
                                <td><?php echo $fila["nombres"]; ?></td>
                                <td><?php echo $fila["ci"]; ?></td>
                                <td><?php echo $fila["telefono"]; ?></td>
                                <td><?php echo $fila["direccion"]; ?></td>
                                <td>
                                    <a class="btn btn-info" role="button" href="#" onclick="modificarPersona(<?php echo $fila['id_persona']; ?>)">Modificar</a>
                                    <a class="btn btn-danger" role="button" href="#"
                                        data-id-persona="<?php echo $fila['id_persona']; ?>"
                                        data-nombres="<?php echo $fila['nombres']; ?>"
                                        data-ap="<?php echo $fila['ap']; ?>"
                                        data-am="<?php echo $fila['am']; ?>"
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
    function modificarPersona(idPersona) {
        const form = document.createElement('form');
        form.method = 'post';
        form.action = 'persona_modificar.php';

        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'id_persona';
        input.value = idPersona;

        form.appendChild(input);
        document.body.appendChild(form);
        form.submit();
    }

    function eliminarPersona(idPersona, nombres, ap, am) {

        const form = document.createElement('form');
        form.method = 'post';
        form.action = 'persona_eliminar.php';

        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'id_persona';
        input.value = idPersona;

        form.appendChild(input);
        document.body.appendChild(form);
        form.submit();
    }

    function mostrarMensaje(button) {
        var contenedorMensajes = document.getElementById('contenedor-mensajes');
        contenedorMensajes.innerHTML = '';
        var idPersona = button.getAttribute('data-id-persona');
        var nombres = button.getAttribute('data-nombres');
        var ap = button.getAttribute('data-ap');
        var am = button.getAttribute('data-am');

        var mensajeDiv = document.createElement('div');
        mensajeDiv.className = 'row';
        mensajeDiv.style.marginBottom = '20px';
        mensajeDiv.style.border = '1px solid #ddd';
        mensajeDiv.style.padding = '15px';
        mensajeDiv.style.borderRadius = '10px';

        var mensajeHTML = `
        <div class="col-lg-12">
            <h4>¿Estás seguro de que quieres eliminar a esta persona?</h4>
            <p><strong>${nombres} ${ap} ${am}</strong></p>
            <a class="btn btn-danger" role="button" href="#" onclick="eliminarYOcultar(${idPersona}, '${nombres}', '${ap}', '${am}', this)">
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

    function eliminarYOcultar(idPersona, nombres, ap, am, button) {
        eliminarPersona(idPersona, nombres, ap, am);
        cancelarMensaje(button);
    }

    function cancelarMensaje(button) {
        var mensajeDiv = button.closest('.row');
        mensajeDiv.remove();
    }

    function aceptarMensaje() {

        var contenedorMensajes = document.getElementById('contenedor-mensajes');
        contenedorMensajes.innerHTML = '';
        window.location.href = 'personas.php';
    }
</script>
<?php include("../../footer.php"); ?>