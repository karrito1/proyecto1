<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Empleados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <div class="container-fluid row d-flex justify-content-center" style="background-color: #73b473ff;">
        <h1 class="text-center">ELIMINAR REGISTRO</h1>

        <form id="formEliminar" class="col-md-4 p-3 my-4 border rounded bg-light">
            <h3 class="text-center text-secondary">ELIMINAR PERSONAS</h3>

            <div class="row text-center">
                <div class="col-6 mb-3">
                    <label class="form-label">NOMBRE COMPLETO</label>
                    <input type="text" class="form-control form-control-sm" name="nombre" required>
                </div>
                <div class="col-6 mb-3">
                    <label class="form-label">NUMERO DOCUMENTO</label>
                    <input type="text" class="form-control form-control-sm" name="numeroDocumento" required>
                </div>
            </div>

            <button type="submit" class="btn btn-success w-25" name="btneliminar_registros" value="ok">
                Eliminar registros
            </button>
        </form>
    </div>
    <script>
        document.getElementById("formEliminar")?.addEventListener("submit", function(e) {
            e.preventDefault();
            const form = this;
            const formData = new FormData(form);

            Swal.fire({
                title: "¿Estás seguro?",
                text: "Esta acción marcará al empleado como INACTIVO",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Sí, eliminar"
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch("../controller/eliminar_registro.php", {
                            method: "POST",
                            body: formData
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.status === "success") {
                                Swal.fire({
                                    icon: "success",
                                    title: "Empleado eliminado",
                                    text: data.message,
                                    timer: 2000,
                                    showConfirmButton: false
                                }).then(() => window.location.href = "usuarios.php");
                            } else {
                                Swal.fire({
                                    icon: "error",
                                    title: "Error",
                                    text: data.message
                                });
                            }
                        })
                        .catch(err => {
                            console.error(err);
                            Swal.fire({
                                icon: "error",
                                title: "Error inesperado",
                                text: "No se pudo procesar la solicitud"
                            });
                        });
                }
            });
        });
    </script>

</body>

</html>