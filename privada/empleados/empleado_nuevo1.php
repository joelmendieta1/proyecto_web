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
$ap = $_POST["ap"];
$am = $_POST["am"];
$nombre = $_POST["nombre"];
$ci = $_POST["ci"];
$telefono = $_POST["telefono"];
$fecha_inicio = $_POST["fecha_inicio"];
$fecha_fin = $_POST["fecha_fin"];
if(($nombre!="") and  ($ci!="") and  ($telefono!="")
){
   $reg = array();
   $reg["id_peluqueria"] = 1;
   $reg["ap"] = $ap;
   $reg["am"] = $am;
   $reg["nombre"] = $nombre;
   $reg["ci"] = $ci;
   $reg["telefono"] = $telefono;
   $reg["fecha_inicio"] = $fecha_inicio;
   $reg["fecha_fin"] = $fecha_fin;

   $reg["fecha_insercion"] = date("Y-m-d H:i:s");
   $reg["estado"] = 'A';
   $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
   $rs1 = $db->AutoExecute("empleados", $reg, "INSERT"); 
   header("Location: empleados.php");
   exit();
} else {
           echo "<script type='text/javascript'>
   window.location.href = 'empleados.php';
</script>";
   }


echo "</body>
      </html> ";
?> 