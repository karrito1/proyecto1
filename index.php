<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f1f1f1;
        }

        .login-container {
            max-width: 380px;
            margin: 80px auto;
            background: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
        }

        h5 {
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        .btn-primary {
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h5 class="text-center">INICIO DE SESIÓN</h5>

        <?php if (isset($_GET['error']) && $_GET['error'] == 1): ?>
            <div class="alert alert-danger text-center" role="alert">
                Número de documento o contraseña incorrectos.
            </div>
        <?php endif; ?>

        <!-- IMPORTANTE: acción apunta directo al controller -->
        <form method="POST" action="controller/login_usuarios.php">

            <!-- Documento -->
            <div class="mb-3">
                <label class="form-label" for="numeroDocumento">Número Documento</label>
                <input type="number" class="form-control" name="numeroDocumento" required />
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label class="form-label" for="password">Password</label>
                <input type="password" class="form-control" name="passwordd" required />
            </div>

            <!-- Botón -->
            <button type="submit" class="btn btn-primary" name="btniniciarsesion" value="ok">
                INICIAR SESIÓN
            </button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>