<?php
// Iniciar sesión
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION["sesion_id_rol"])) {
    // Si no ha iniciado sesión, redirigir al login
    header("Location: index.php");
    exit();
}
if (isset($_SESSION['mensaje'])) {
    $mensaje = $_SESSION['mensaje'];
    $mensaje1 = $_SESSION['mensaje1'];
    $nom_completo = $_SESSION['nom_completo'];

    unset($_SESSION['mensaje']);
    unset($_SESSION['mensaje1']);
    unset($_SESSION['nom_completo']);
}
?>
<?php include("header.php");?>
<br>
<?php if (isset($mensaje)): ?>
    <div class="alert alert-dark" role="alert" style="max-width: 90%; margin: auto; padding: 20px; text-align: center;">
        <h4><?php echo $mensaje; ?></h4>
        <p><?php echo $mensaje1; ?></p>
        <p><strong><?php echo $nom_completo; ?></strong></p>
    </div>
<?php endif; ?>

<div class="container" style="max-width: 90%; margin: auto; padding: 20px;">
    <?php if (!empty($mensajes)): ?>
        <?php foreach ($mensajes as $mensaje): ?>
            <div class="row" style="margin-bottom: 20px; border: 1px solid #ddd; padding: 15px; border-radius: 10px;">
                <div class="col-lg-12">
                    <h4><?php echo $mensaje['titulo']; ?></h4>
                    <p><?php echo $mensaje['contenido']; ?></p>
                    <p><strong><?php echo $mensaje['nom_completo']; ?></strong></p>
                    <a class="btn btn-danger" role="button" href="#" onclick="<?php echo $mensaje['accion']; ?>">
                        <?php echo $mensaje['boton_texto']; ?>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
<?php include("footer.php");?>
