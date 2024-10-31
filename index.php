<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="./css/bootstrap.min.css" rel="stylesheet" />
</head>

<body class="p-3 mb-2 bg-success text-black">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <br><br><br>

                <?php
                session_start();

                if (isset($_SESSION['mensaje']) && isset($_SESSION['mensaje1'])): ?>
                    <div class="alert alert-danger" role="alert" style="max-width: 90%; margin: auto; padding: 20px; text-align: center;">
                        <h4><?php echo $_SESSION['mensaje']; ?></h4>
                        <p><?php echo $_SESSION['mensaje1']; ?></p>
                    </div>
                <?php

                    unset($_SESSION['mensaje']);
                    unset($_SESSION['mensaje1']);
                endif;
                ?>

                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center">Iniciar sesión</h2>
                        <form action="validar.php" method="post" autocomplete="off">
                            <div class="form-group">
                                <label for="nick">Usuario:</label>
                                <input type="text" id="nick" name="nick" class="form-control" placeholder="Ingrese su usuario">
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="password">Contraseña:</label>
                                <input type="password" id="password" name="password" class="form-control" placeholder="Ingrese su contraseña">
                            </div>
                            <br>
                            <div class="row g-3 justify-content-center">
                                <div class="form-group col-auto">
                                    <button type="submit" name="accion" value="Ingresar" class="btn btn-primary btn-block">Acceder</button>
                                </div>
                                <div class="form-group col-auto">
                                    <button type="reset" class="btn btn-danger btn-block">Cancelar</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>