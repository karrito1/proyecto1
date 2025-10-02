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
    <script src="https://kit.fontawesome.com/068a4d5189.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <div class="container-fluid row" style="background-color: #73b473ff;">
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
                 LEFT JOIN cargo c 
                    ON e.cargo_idcargo = c.idcargo    
                 LEFT JOIN departamento d 
                    ON e.departamento_iddepartamento = d.iddepartamento";
                        $resultado = $mysql->efectuarConsulta($consulta);
                        while ($fila = mysqli_fetch_assoc($resultado)) { ?>
                            <tr>
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
                                    <a href="./modificar_registro.php?idempleados=<?= $fila['id'] ?>" class="btn btn-sm btn-warning">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a href="./eliminar_registros.php?idempleados=<?= $fila['id'] ?>" class="btn btn-sm btn-danger">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php }
                        $mysql->desconectar(); ?>
                    </tbody>

                </table>


                <form method="post" action="generar_Pdf.php" target="_blank">
                    <input type="hidden" name="btnimprimirpdf" value="ok">
                    <button type="submit" class="btn btn-sm btn-danger">
                        <i class="fa-solid fa-file-pdf"></i> PDF
                    </button>
                </form>
                <form method="post" action="pdfDepartamento.php" target="_blank">
                    <div class="mb-3">
                        <label for="departamento" class="form-label">PDF por Departamento</label>
                        <select name="departamento" id="departamento" class="form-select form-select-sm" required>
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
                    </div>
                    <button type="submit" class="btn btn-sm btn-success">
                        <i class="fa-solid fa-file-pdf"></i> PDF por Departamento
                    </button>
                </form>

                <br>
                <h2>Reporte de empleados</h2>
                <button id="btnMostrarEstadisticas">Mostrar Estadisticas</button>

                <div id="estadisticas" style="display:none;">
                    <canvas id="graficoempleados" width="600" height="400"></canvas>
                    <canvas id="graficoCargos" width="600" height="400"></canvas>
                </div>

                <script src="../public/js/grafico_empleados.js"></script>
                <script src="../public/js/grafico_cargos.js"></script>
                <script>
                    document.getElementById("btnMostrarEstadisticas").addEventListener("click", function() {
                        document.getElementById("estadisticas").style.display = "block";
                        mostrarGraficoEmpleados();
                        mostrarGraficoCargos();
                    });
                </script>


            </div>
        </div>
    </div>
    <script>
        document.getElementById("formRegistro").addEventListener("submit", function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            formData.append("btn_registrar", "ok");

            fetch("../controller/registrousuarios.php", {
                    method: "POST",
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === "success") {
                        Swal.fire("Éxito", data.message, "success").then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire("Error", data.message, "error");
                    }
                })
                .catch(err => {
                    console.error("Error en la petición:", err);
                    Swal.fire("Error", "No se pudo conectar con el servidor", "error");
                });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>