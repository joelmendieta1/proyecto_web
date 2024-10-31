<?php
session_start();
require_once("../../conexion.php");

if (!isset($_SESSION["sesion_id_rol"])) {
   // Si no ha iniciado sesión, redirigir al login
   header("Location: index.php");
   exit();
}
?>

<?php
// Recibir el nombre de la categoría desde el formulario
$nombre = $_POST["nombre"];

// Verificar que el nombre no esté vacío
if (!empty($nombre)) {
   $reg = array();
   // Asignar los valores correspondientes
   $reg["id_peluqueria"] = 1; // Asigna el ID de peluquería según corresponda
   $reg["nombre"] = $nombre;
   $reg["fecha_insercion"] = date("Y-m-d H:i:s");
   $reg["estado"] = 'A'; // Estado activo
   $reg["usuario"] = $_SESSION["sesion_id_usuario"]; // Usuario que realiza la inserción

   // Insertar los datos en la tabla categorias_servicios
   $rs1 = $db->AutoExecute("categorias_servicios", $reg, "INSERT");

   // Redirigir al listado de categorías de servicios después de la inserción
   header("Location: categorias_servicios.php");
   exit();
} else {
   // Si el nombre está vacío, redirigir al formulario de nuevo
   echo "<script type='text/javascript'>
   window.location.href = 'categoria_servicio.php';
   </script>";
}

echo "</body>
      </html>";
?>
