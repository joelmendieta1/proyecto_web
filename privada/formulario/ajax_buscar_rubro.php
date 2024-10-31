<?php
session_start();
require_once("../../conexion.php");

if (isset($_POST['rubro'])) {
    $rubro_id = $_POST['rubro'];

    $sql = $db->Prepare("SELECT id_categoria, categoria_rubro 
                         FROM categorias 
                         WHERE id_rubro = ? AND estado = 'A'");
    $rs = $db->GetAll($sql, array($rubro_id));

    if ($rs) {
        echo "
        <div class='d-flex align-items-center mb-3'>
            <label for='categoria' class='form-label me-3' style='width: 250px;'>(*)Seleccione Categoría</label>
            <select name='categoria' class='form-select' style='width: 50%;' required onchange='listarActivos()'>
                <option value=''>Selecciona una opción</option>";
        foreach ($rs as $fila) {
            echo "<option value='{$fila['id_categoria']}'>{$fila['categoria_rubro']}</option>";
        }
        echo "</select>
        </div>";
    } else {
        echo "
        <div class='d-flex align-items-center mb-3'>
            <label for='categoria' class='form-label me-3' style='width: 250px;'>(*)Seleccione Categoría</label>
            <select name='categoria' class='form-select' style='width: 50%;' required>
                <option value=''>No hay categorías disponibles</option>
            </select>
        </div>";
    }
}
