<?php
session_start();
require_once("../../conexion.php");

if (isset($_POST['categoria'])) {
    $categoria_id = $_POST['categoria'];

    $sql = $db->Prepare("SELECT id_categoria 
                         FROM categorias 
                         WHERE id_categoria = ?");
    $rs = $db->GetRow($sql, array($categoria_id));

    if ($rs) {
        echo "
        <form method='POST' action='guardar_activo.php'>
            <div class='d-flex flex-column align-items-start mb-3'>
                <label for='descripcion' class='form-label'>Descripción</label>
                <input type='text' class='form-control mb-2' name='descripcion' required>
                
                <label for='fecha_adquisicion' class='form-label'>Fecha de Adquisición</label>
                <input type='date' class='form-control mb-2' name='fecha_adquisicion' required>

                <label for='fecha_adquisicion' class='form-label'>Fecha de activacion</label>
                <input type='date' class='form-control mb-2' name='fecha_adquisicion' required>

                <label for='valor' class='form-label'>Fotocopia</label>
                <input type='number' step='0.01' class='form-control mb-2' name='valor' required>

                <label for='valor' class='form-label'>Numero documento</label>
                <input type='number' step='0.01' class='form-control mb-2' name='valor' required>
                
                <label for='valor' class='form-label'>Valor</label>
                <input type='number' step='0.01' class='form-control mb-2' name='valor' required>

                <label for='valor' class='form-label'>Valor Residual</label>
                <input type='number' step='0.01' class='form-control mb-2' name='valor' required>
                
                <label for='responsable' class='form-label'>Responsable</label>
                <input type='text' class='form-control mb-2' name='responsable' required>";

        if ($categoria_id >= 4 && $categoria_id <= 15) {
            echo "
                <label for='depreciacion' class='form-label'>Depreciación</label>
                <input type='text' class='form-control mb-2' name='depreciacion'>";
        }

        if ($categoria_id >= 9 && $categoria_id <= 15) {
            echo "
                <label for='marca_del_activo' class='form-label'>Marca del Activo</label>
                <input type='text' class='form-control mb-2' name='marca_del_activo'>";
        }

        if ($categoria_id == 14) {
            echo "
                <label for='nro_serie_placa' class='form-label'>Nro. Serie/Placa</label>
                <input type='text' class='form-control mb-2' name='nro_serie_placa'>";
        }

        echo "
            </div>
            <button type='submit' class='btn btn-primary'>Guardar</button>
        </form>";
    }
}
