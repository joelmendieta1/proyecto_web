<?php
session_start();
require_once("../../conexion.php");
require_once("../../header.php");
$sql = $db->Prepare(" SELECT  id_rubro,rubro
                    FROM    rubros 
                    WHERE   estado='A'
                    ");
$rs = $db->GetAll($sql);
?>
<html>

<head>
    <link href='../../css/bootstrap.min.css' rel='stylesheet' />
    <script type='text/javascript' src='../../ajax.js'></script>
    <script type='text/javascript' src='./js/buscar.js'></script>
</head>

<body>
    <br>
    <div class="card">
        <br>
        <div class="container d-flex justify-content-center">
            <div class="card" style="width: 50%; ">
                <div class="card-header d-flex justify-content-center bg-primary text-white">
                    <h4>Formulario Dinamico</h4>
                </div>
                <div class="card-body">
                    <form action="" name="formu">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex align-items-center mb-3">
                                    <label for="nombre" class="form-label me-3" style="width: 250px;">(*)Seleccione un Rubro</label>
                                    <select name="rubro" class="form-select" style="width: 50%;" onchange="buscarCategorias()" required>
                                        <option value="">Selecciona una opción</option>
                                        <?php foreach ($rs as $fila) { ?>
                                            <option value="<?php echo $fila['id_rubro'] ?>"> <?php echo $fila['rubro'] ?> </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12" id="categoriaContainer">
                            </div>
                            <div class="col-md-12" id="activosContainer">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <br>
    </div>
    <script type='text/javascript' src='../js/validar.js'></script>
    <script src='../../js/bootstrap.bundle.min.js'></script>
</body>

</html>