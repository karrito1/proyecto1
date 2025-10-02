<?php
include_once "../models/MySQL.php";

$mysql = new MySQL();
$mysql->conectar();

// CARGOS
$queryCargos = "SELECT idcargo, nombreCargo FROM cargo";
$resultadoCargos = $mysql->efectuarConsulta($queryCargos);

// DEPARTAMENTOS
$queryDepartamentos = "SELECT iddepartamento, nombreDepartamento FROM departamento";
$resultadoDepartamentos = $mysql->efectuarConsulta($queryDepartamentos);

$mysql->desconectar();
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Empleados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/estilos.css">
    <script src="https://kit.fontawesome.com/068a4d5189.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <div class="container-fluid row" style="background-color: #008000;">
        <h1 class="text-center">DATOS REGISTRO</h1>

        <!-- FORMULARIO DE REGISTRO -->
        <form class="col-md-4 p-3 my-4 border rounded bg-light" method="POST" enctype="multipart/form-data" id="formRegistro">
            <h3 class="text-center text-secondary">REGISTRO PERSONAS</h3>
            <!-- Campos de registro -->
            <div class="row">
                <div class="col-6 mb-3">
                    <label class="form-label">NOMBRE COMPLETO</label>
                    <input type="text" class="form-control form-control-sm" name="nombre" required>
                </div>
                <div class="col-6 mb-3">
                    <label class="form-label">NUMERO DOCUMENTO</label>
                    <input type="text" class="form-control form-control-sm" name="numeroDocumento" required>
                </div>
            </div>

            <div class="row">
                <div class="col-6 mb-3">
                    <label class="form-label">CARGO</label>
                    <select class="form-select form-select-sm" name="cargo" required>
                        <option value="">Seleccione un cargo</option>
                        <?php while ($cargo = mysqli_fetch_assoc($resultadoCargos)) { ?>
                            <option value="<?= $cargo['idcargo'] ?>"><?= $cargo['nombreCargo'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-6 mb-3">
                    <label class="form-label">DEPARTAMENTO</label>
                    <div>
                        <?php while ($dpto = mysqli_fetch_assoc($resultadoDepartamentos)) { ?>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input form-check-input-sm" type="radio" name="departamento" value="<?= $dpto['iddepartamento'] ?>" id="dpto<?= $dpto['iddepartamento'] ?>" required>
                                <label class="form-check-label" for="dpto<?= $dpto['iddepartamento'] ?>"><?= $dpto['nombreDepartamento'] ?></label>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-6 mb-3">
                    <label class="form-label">FECHA INGRESO</label>
                    <input type="date" class="form-control form-control-sm" name="fechaIngreso" required>
                </div>
                <div class="col-6 mb-3">
                    <label class="form-label">SALARIO</label>
                    <input type="number" class="form-control form-control-sm" name="salario" required>
                </div>
            </div>

            <div class="row">
                <div class="col-6 mb-3">
                    <label class="form-label">CORREO</label>
                    <input type="email" class="form-control form-control-sm" name="correo" required>
                </div>
                <div class="col-6 mb-3">
                    <label class="form-label">TELeFONO</label>
                    <input type="text" class="form-control form-control-sm" name="telefono" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">PASSWORD</label>
                <input type="password" class="form-control form-control-sm" name="password" required>
            </div>
            <div class="mb-3">
                <label class="form-label">ESTADO</label>
                <input type="text" class="form-control form-control-sm" name="estado" required>
            </div>
            <div class="mb-3">
                <label class="form-label">IMAGEN</label>
                <input type="file" class="form-control form-control-sm" name="imagen" required>
            </div>

            <button type="submit" class="btn btn-primary w-100" name="btn_registrar" value="ok">Registrar</button>
        </form>

        <!-- TABLA DE EMPLEADOS -->
        <div class="col-8 p-4">
            <div class="table-responsive">
                <table class="table table-sm table-bordered" style="font-size: 0.85rem;">
                    <thead class="table-info">
                        <tr>
                            <th>ID</th>
                            <th>CARGO</th>
                            <th>AREA</th>
                            <th>NOMBRE</th>
                            <th>DOCUMENTO</th>
                            <th>FECHA INGRESO</th>
                            <th>SALARIO</th>
                            <th>CORREO</th>
                            <th>TELEFONO</th>
                            <th>ESTADO</th>
                            <th>IMAGEN</th>
                            <th>ACCION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $mysql->conectar();
                        $consulta = "SELECT  
    e.idempleados AS id,
    e.nombreEmpleado AS nombre,
    e.numeroDocumento AS documento,
    e.fechaIngreso AS fecha_ingreso,
    e.correo AS correo,
    e.telefono AS telefono,
    e.salario AS salario,
    e.estado AS estado,
    c.nombreCargo AS cargo,
    d.nombreDepartamento AS departamento,
    e.imagen AS imagen 
 FROM empleados e
 LEFT JOIN cargo c ON e.cargo_idcargo = c.idcargo    
 LEFT JOIN departamento d ON e.departamento_iddepartamento = d.iddepartamento";

                        $resultado = $mysql->efectuarConsulta($consulta);
                        while ($fila = mysqli_fetch_assoc($resultado)) { ?>
                            <tr data-id="<?= $fila['id'] ?>">
                                <td><?= $fila['id'] ?></td>
                                <td><?= $fila['cargo'] ?></td>
                                <td><?= $fila['departamento'] ?></td>
                                <td><?= $fila['nombre'] ?></td>
                                <td><?= $fila['documento'] ?></td>
                                <td><?= $fila['fecha_ingreso'] ?></td>
                                <td><?= $fila['salario'] ?></td>
                                <td><?= $fila['correo'] ?></td>
                                <td><?= $fila['telefono'] ?></td>
                                <td><?= $fila['estado'] ?></td>
                                <td>
                                    <?php if (!empty($fila['imagen'])): ?>
                                        <img src="../<?= htmlspecialchars($fila['imagen']) ?>" width="60" height="60" style="object-fit: cover; border-radius: 5px;">
                                    <?php else: ?>
                                        Sin imagen
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <!-- Botón Editar -->
                                    <a href="./modificar_registro.php?idempleados=<?= $fila['id'] ?>" class="btn btn-sm btn-primary">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <!-- Botón Eliminar -->
                                    <button class="btn btn-danger btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalEliminar"
                                        data-nombre="<?= $fila['nombre'] ?>"
                                        data-documento="<?= $fila['documento'] ?>">
                                        <i class="fa-solid fa-user-slash"></i>
                                    </button>


                                </td>
                            </tr>
                        <?php }
                        $mysql->desconectar();
                        ?>
                    </tbody>

                </table>
                <!-- Botones de acciones -->
                <div class="d-flex gap-2 mb-4">
                    <form method="post" action="generar_Pdf.php" target="_blank" class="m-0">
                        <input type="hidden" name="btnimprimirpdf" value="ok">
                        <button type="submit" class="btn btn-sm btn-danger">
                            <i class="fa-solid fa-file-pdf"></i> PDF
                        </button>
                    </form>

                    <form method="post" action="pdfDepartamento.php" target="_blank" class="m-0">
                        <select name="departamento" id="departamento" class="form-select form-select-sm me-2" required style="width: auto; min-width: 180px;">
                            <option value="">Seleccione...</option>
                            <?php
                            $mysql->conectar();
                            $queryDeptos = "SELECT iddepartamento, nombreDepartamento FROM departamento";
                            $resDeptos = $mysql->efectuarConsulta($queryDeptos);
                            while ($dep = mysqli_fetch_assoc($resDeptos)) {
                                echo '<option value="' . $dep['iddepartamento'] . '">' . $dep['nombreDepartamento'] . '</option>';
                            }
                            $mysql->desconectar();
                            ?>
                        </select>
                        <button type="submit" class="btn btn-sm btn-danger">
                            <i class="fa-solid fa-file-pdf"></i> PDF por Departamento
                        </button>
                    </form>

                    <button class="btn btn-primary btn-sm ms-auto" data-bs-toggle="modal" data-bs-target="#modalEstadisticas">
                        Mostrar Estadísticas
                    </button>
                </div>


                <br>




            </div>
        </div>
    </div>
    <script>
        document.querySelector("#formRegistro")?.addEventListener("submit", function(e) {
            e.preventDefault();
            const form = this;
            const formData = new FormData(form);
            formData.append("btn_registrar", "ok");

            Swal.fire({
                title: "¿Confirmar registro?",
                text: "Se guardará un nuevo usuario en el sistema",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Si, registrar",
                cancelButtonText: "Cancelar el proceso",
                confirmButtonColor: "#28a745",
                cancelButtonColor: "#6c757d",
                reverseButtons: true

            }).then((result) => {
                if (result.isConfirmed) {
                    fetch("../controller/registrousuarios.php", {
                            method: "POST",
                            body: formData
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.status === "success") {
                                Swal.fire({
                                    icon: "success",
                                    title: "¡Registrado!",
                                    text: data.message,
                                    timer: 2000,
                                    showConfirmButton: false
                                }).then(() => location.reload());
                            } else {
                                Swal.fire({
                                    icon: "error",
                                    title: "Error",
                                    text: data.message
                                });
                            }
                        })
                        .catch(errorrr => {
                            console.error("Error en la petición:", errorrr);
                            Swal.fire({
                                icon: "error",
                                title: "Error inesperado",
                                text: "No se pudo conectar con el servidor"
                            });
                        });
                }
            });
        });
    </script>

    <div class="modal fade" id="modalEstadisticas" tabindex="-1" aria-labelledby="modalEstadisticasLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalEstadisticasLabel">Estadisticas de Empleados</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <canvas id="graficoempleados" style="width: 100%; height: 250px;"></canvas>
                    <canvas id="graficoCargos" style="width: 100%; height: 250px;"></canvas>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <script src="../public/js/grafico_empleados.js"></script>
    <script src="../public/js/grafico_cargos.js"></script>

    <script>
        const modalEstadisticas = document.getElementById('modalEstadisticas');
        modalEstadisticas.addEventListener('shown.bs.modal', function() {
            mostrarGraficoEmpleados();
            mostrarGraficoCargos();
        });
    </script>
    <!-- Modal Eliminar -->
    <!-- Modal Eliminar -->
    <div class="modal fade" id="modalEliminar" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="formEliminar">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">eliminar Empleado</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="nombre" id="nombreEliminar">
                        <input type="hidden" name="numeroDocumento" id="documentoEliminar">
                        <p>¿Seguro que deseas poner <strong id="nombreMostrar"></strong> como <b>INACTIVO</b>?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Inactivar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        let modalEliminar = document.getElementById('modalEliminar');

        // Pasar datos al modal
        modalEliminar.addEventListener('show.bs.modal', function(event) {
            let button = event.relatedTarget;
            let nombre = button.getAttribute('data-nombre');
            let documento = button.getAttribute('data-documento');

            document.getElementById("nombreEliminar").value = nombre;
            document.getElementById("documentoEliminar").value = documento;
            document.getElementById("nombreMostrar").textContent = nombre;
        });

        document.getElementById("formEliminar").addEventListener("submit", function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            fetch("../controller/eliminar_registro.php", {
                    method: "POST",
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if (data.carepingo === "estovapasar") {
                        Swal.fire({
                            icon: "success",
                            title: "Empleado Inactivado",
                            text: data.message,
                            timer: 2000,
                            showConfirmButton: false
                        });

                        let documento = formData.get("numeroDocumento");
                        let row = document.querySelector(`tr[data-documento='${documento}'] td:nth-child(10)`);
                        if (row) row.textContent = "INACTIVO";

                        let modal = bootstrap.Modal.getInstance(modalEliminar);
                        modal.hide();
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
        });
    </script>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>