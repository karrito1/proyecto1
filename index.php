<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplo con Bootstrap</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid mt-5" style="max-width: 400px; margin:auto; background-color: #f8f9fa">
        <h5 class="text-center">INICIO DE SESION</h5>

        <?php if (isset($_GET['error']) && $_GET['error'] == 1): ?>
            <div class="alert alert-danger text-center" role="alert">
                 Número de documento o contraseña incorrectos.
            </div>
        <?php endif; ?>

        <!-- IMPORTANTE: acción apunta directo al controller -->
        <form method="POST" action="controller/login_usuarios.php" class="border p-4 rounded bg-light shadow-sm">

            <!-- Documento -->
            <div class="form-outline mb-4">
                <input type="number" class="form-control" name="numeroDocumento" required />
                <label class="form-label" for="numeroDocumento">Número Documento</label>
            </div>

            <!-- Password -->
            <div class="form-outline mb-4">
                <input type="password" class="form-control" name="passwordd" required />
                <label class="form-label" for="password">Password</label>
            </div>

            <!-- Botón -->
            <button type="submit" class="btn btn-primary btn-block" name="btniniciarsesion" value="ok">
                INICIAR SESION
            </button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>