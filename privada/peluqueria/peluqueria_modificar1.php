<?php
session_start();
require_once("../../conexion.php");

$id_peluqueria = $_POST["id_peluqueria"];
$nombre = $_POST["nombre"];
$telefono = $_POST["telefono"];
$direccion = $_POST["direccion"];

if (isset($_FILES["logo"]) && $_FILES["logo"]["error"] == 0) {
    $logo = $_FILES["logo"]["name"];
    $tmp_logo = $_FILES["logo"]["tmp_name"];
    $upload_dir = "logos/";

    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $upload_file = $upload_dir . basename($logo);
    $file_extension = pathinfo($upload_file, PATHINFO_EXTENSION);
    $unique_logo_name = $id_peluqueria . 'logo.' . $file_extension;
    $upload_path = $upload_dir . $unique_logo_name;

    if (move_uploaded_file($tmp_logo, $upload_path)) {
        $reg["logo"] = $unique_logo_name;
    } else {
        die("Error al cargar el archivo.");
    }
} else {
    $sql = "SELECT logo FROM peluqueria WHERE id_peluqueria=?";
    $stmt = $db->Prepare($sql);
    $rs = $db->Execute($stmt, array($id_peluqueria));
    if ($rs && !$rs->EOF) {
        $reg["logo"] = $rs->fields["logo"];
    }
}

if (($nombre != "") && ($telefono != "") && ($direccion != "")) {
    $reg["nombre"] = $nombre;
    $reg["telefono"] = $telefono;
    $reg["direccion"] = $direccion;
    $reg["usuario"] = $_SESSION["sesion_id_usuario"];

    $rs1 = $db->AutoExecute("peluqueria", $reg, "UPDATE", "id_peluqueria='" . $id_peluqueria . "'");
    if ($rs1) {
        header("Location: peluqueria.php");
        exit();
    } else {
        require_once("../../libreria_menu.php");
        echo "<div class='mensaje'>";
        $mensage = "NO SE MODIFICARON LOS DATOS DE LA PELUQUERIA";
        echo "<h1>" . $mensage . "</h1>";

        echo "<a href='peluqueria.php'>
                  <input type='button' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>
            ";
        echo "</div>";
    }
}

echo "</body>
      </html>";
?>