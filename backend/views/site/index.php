<?php

use yii\helpers\Url;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var int $totalProjects */

//Envio de los datos obtenidos de la consulta del controlador y los manda al archivo js relacionado con la pagina
$this->registerJs(
    "let projectStatusCounts = " . json_encode($statusCounts) . ";
     const expedienteData = " . json_encode($totalFiles) . ";
     const teachers = " . json_encode($teachers) . ";
     let totalTeachers = " . json_encode($totalTeachersGrafica) . ";
     ",
    \yii\web\View::POS_HEAD
);


//Llamdo al alrchivo js donde se configuran el manejo de la informacion
$this->registerJsFile(
    '@web/theme/functionAjax/dashboardAjax.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);

?>
<div id="layout-wrapper">

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="">

        <div class="">
            <div class="container-fluid">


                <div class="row project-wrapper">
                    <div class="col-xxl-12">
                        <div class="row">
                            <div class="col-xl-4">

                                <div class="card card-animate">

                                    <div class="card-body">

                                        <div class="d-flex align-items-center">

                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-primary-subtle text-primary rounded-2 fs-2">
                                                    <i data-feather="folder" class="text-primary"></i>
                                                </span>
                                            </div>

                                            <div class="flex-grow-1 overflow-hidden ms-3">
                                                <p class="text-uppercase fw-medium text-muted text-truncate mb-3">Proyectos</p>

                                                <div class="d-flex align-items-center mb-3">
                                                    <h4 class="flex-grow-1 mb-0"><span class="counter-value" data-target="<?php echo $totalProjects ?>">0</span></h4>
                                                    <div class="flex-shrink-0 align-self-center">
                                                        <a href="<?= Url::to(['/proyecto']); ?>" class="text-decoration-underline">Ver mas detalles</a>
                                                    </div>
                                                </div>

                                                <p class="text-muted text-truncate mb-0">Proyectos en el sistema</p>

                                            </div>

                                        </div>

                                    </div><!-- end card body -->

                                </div>
                            </div><!-- end col -->

                            <div class="col-xl-4">

                                <div class="card card-animate">

                                    <div class="card-body">

                                        <div class="d-flex align-items-center">

                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-secondary-subtle rounded-2 fs-2">
                                                    <i data-feather="award" class="text-secondary"></i>
                                                </span>
                                            </div>

                                            <div class="flex-grow-1 ms-3">

                                                <p class="text-uppercase fw-medium text-muted mb-3">Docentes</p>

                                                <div class="d-flex align-items-center mb-3">
                                                    <h4 class="flex-grow-1 mb-0"><span class="counter-value" data-target="<?php echo $totalTeachers ?>">0</span></h4>
                                                    <div class="flex-shrink-0 align-self-center">
                                                        <a href="<?= Url::to(['/asesor-interno']); ?>" class="text-decoration-underline">Ver mas detalles</a>
                                                    </div>
                                                </div>

                                                <p class="text-muted mb-0">Docentes en el sistema</p>

                                            </div>

                                        </div>

                                    </div><!-- end card body -->

                                </div>
                            </div><!-- end col -->

                            <div class="col-xl-4">
                                <div class="card card-animate">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-warning-subtle text-warning rounded-2 fs-2">
                                                    <i data-feather="users" class="text-warning"></i>
                                                </span>
                                            </div>
                                            <div class="flex-grow-1 overflow-hidden ms-3">
                                                <p class="text-uppercase fw-medium text-muted text-truncate mb-3">Alumnos</p>
                                                <div class="d-flex align-items-center mb-3">
                                                    <h4 class="flex-grow-1 mb-0"><span class="counter-value" data-target="<?php echo $totalStudents ?>">0</span></h4>
                                                    <div class="flex-shrink-0 align-self-center">
                                                        <a href="<?= Url::to(['/expediente']); ?>" class="text-decoration-underline">Ver mas detalles</a>
                                                    </div>
                                                </div>
                                                <p class="text-muted text-truncate mb-0">Alumnos en el sistema</p>
                                            </div>
                                        </div>
                                    </div><!-- end card body -->
                                </div>
                            </div><!-- end col -->
                        </div><!-- end row -->
                    </div><!-- end col -->
                </div><!-- end row -->

                <div class="row">
                    <div class="col-xl-12">
                        <div class="row">
                            <div class="col-xl-8">
                                <div class="card card-height-100">
                                    <div class="card-header d-flex align-items-center">
                                        <h4 class="card-title flex-grow-1 mb-0">Docentes</h4>

                                        <div class="flex-shrink-0">
                                            <a href="javascript:void(0);" class="btn btn-soft-info btn-sm">Crear reporte</a>
                                        </div>
                                    </div><!-- end cardheader -->
                                    <div class="card-body">

                                        <div class="table-responsive table-card" style="max-height: 300px;">

                                            <table class="table table-nowrap table-centered align-middle" id="teacher-table">

                                                <thead class="bg-light text-muted">
                                                    <tr>
                                                        <th scope="col">id</th>
                                                        <th scope="col">Nombre</th>
                                                        <th scope="col">Ingenieria</th>
                                                        <th scope="col">capacitacion</th>
                                                    </tr><!-- end tr -->
                                                </thead><!-- thead -->

                                                <tbody>

                                                </tbody><!-- end tbody -->

                                            </table><!-- end table -->

                                        </div>
                                        <div class="mt-3 text-center">
                                            <a href="<?= Url::to(['/asesor-interno']); ?>" class="text-muted text-decoration-underline">Ver más</a>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div><!-- end col -->

                            <div class="col-xl-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title mb-0">Docentes con capacitación</h4>
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                        <div id="multiple_radialbar" data-colors='["--vz-primary", "--vz-success", "--vz-warning", "--vz-danger"]' class="apex-charts" dir="ltr"></div>
                                    </div><!-- end card-body -->
                                </div><!-- end card -->
                            </div>
                            <!-- end col -->
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-xl-4">
                        <div class="card card-height-100">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Estado de los proyectos</h4>
                                <!--
                                <div class="flex-shrink-0">
                                    <div class="dropdown card-header-dropdown">
                                        <a class="dropdown-btn text-muted" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            All Time <i class="mdi mdi-chevron-down ms-1"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="#">All Time</a>
                                            <a class="dropdown-item" href="#">Last 7 Days</a>
                                            <a class="dropdown-item" href="#">Last 30 Days</a>
                                            <a class="dropdown-item" href="#">Last 90 Days</a>
                                        </div>
                                    </div>
                                </div>-->
                            </div><!-- end card header -->

                            <div class="card-body">
                                <div id="prjects-status" data-colors='["--vz-info", "--vz-danger", "--vz-success"]' class="apex-charts" dir="ltr"></div>
                                <div class="mt-3">
                                    <div class="d-flex justify-content-center align-items-center mb-4">
                                        <div>
                                            <p class="text-muted mb-0 me-2">Total de proyectos </p>
                                            <!--<p class="text-success fw-medium mb-0">
                                                <span class="badge bg-success-subtle text-success p-1 rounded-circle"><i class="ri-arrow-right-up-line"></i></span> +3 New
                                            </p>-->

                                        </div>
                                        <h2 class="ff-secondary mb-0"><?php echo $totalProjects ?></h2>
                                    </div>

                                    <div class="d-flex justify-content-between border-bottom border-bottom-dashed py-2">
                                        <p class="fw-medium mb-0"><i class="ri-checkbox-blank-circle-fill text-success align-middle me-2"></i> Completados</p>
                                        <div>
                                            <span class="text-muted pe-5" id="estado-3">0 Proyectos</span>
                                        </div>
                                    </div><!-- end -->
                                    <div class="d-flex justify-content-between border-bottom border-bottom-dashed py-2">
                                        <p class="fw-medium mb-0"><i class="ri-checkbox-blank-circle-fill text-warning align-middle me-2"></i> En progreso</p>
                                        <div>
                                            <span class="text-muted pe-5" id="estado-1">0 Proyectos</span>
                                        </div>
                                    </div><!-- end -->
                                    <div class="d-flex justify-content-between border-bottom border-bottom-dashed py-2">
                                        <p class="fw-medium mb-0"><i class="ri-checkbox-blank-circle-fill text-danger align-middle me-2"></i> Cancelados</p>
                                        <div>
                                            <span class="text-muted pe-5" id="estado-2">0 Proyectos</span>
                                        </div>
                                    </div><!-- end -->
                                </div>
                            </div><!-- end cardbody -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-8">
                        <div class="card card-height-100">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1 py-1">Expedientes</h4>
                                <div class="flex-shrink-0">
                                    <a href="javascript:void(0);" class="btn btn-soft-info btn-sm">Crear reporte</a>
                                </div>
                            </div><!-- end card header -->
                            <div class="card-body">
                                <div class="table-responsive table-card" style="max-height: 360px;">
                                    <table class="table table-borderless table-nowrap table-centered align-middle mb-0" id="expedienteTable">
                                        <thead class="table-light text-muted">
                                            <tr>
                                                <th scope="col">Estudiantes</th>
                                                <th scope="col">Creado</th>
                                                <th scope="col">Estado</th>
                                                <th scope="col">Motivo de cierre</th>
                                            </tr>
                                        </thead><!-- end thead -->
                                        <tbody id="detailTable">
                                        </tbody><!-- end tbody -->
                                    </table><!-- end table -->
                                </div>
                                <div class="mt-3 text-center">
                                    <a href="<?= Url::to(['/expediente']); ?>" class="text-muted text-decoration-underline">Ver más</a>
                                </div>
                            </div><!-- end cardbody -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                </div><!-- end row -->



            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

    </div>
    <!-- end main content-->

</div>