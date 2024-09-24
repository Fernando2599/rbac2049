<?php

use yii\helpers\Url;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var int $totalProjects */

$this->registerJs(
    "var projectStatusCounts = " . json_encode($statusCounts) . ";",
    \yii\web\View::POS_HEAD
);

$this->registerJsFile(
    '@web/administrador/functionAjax/dashboardAjax.js',
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
                    <div class="col-xxl-8">
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

                                                    <!--<span class="badge bg-danger-subtle text-danger fs-12"><i class="ri-arrow-down-s-line fs-13 align-middle me-1"></i>5.02 %</span>-->
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
                                                    <!--<span class="badge bg-success-subtle text-success fs-12"><i class="ri-arrow-up-s-line fs-13 align-middle me-1"></i>3.58 %</span>-->
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
                                                    <i data-feather="clock" class="text-warning"></i>
                                                </span>
                                            </div>
                                            <div class="flex-grow-1 overflow-hidden ms-3">
                                                <p class="text-uppercase fw-medium text-muted text-truncate mb-3">Total Hours</p>
                                                <div class="d-flex align-items-center mb-3">
                                                    <h4 class="flex-grow-1 mb-0"><span class="counter-value" data-target="168">0</span>h <span class="counter-value" data-target="40">0</span>m</h4>
                                                    <span class="badge bg-danger-subtle text-danger fs-12"><i class="ri-arrow-down-s-line fs-13 align-middle me-1"></i>10.35 %</span>
                                                </div>
                                                <p class="text-muted text-truncate mb-0">Work this month</p>
                                            </div>
                                        </div>
                                    </div><!-- end card body -->
                                </div>
                            </div><!-- end col -->
                        </div><!-- end row -->

                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-header border-0 align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">Projects Overview</h4>
                                        <div>
                                            <button type="button" class="btn btn-soft-secondary btn-sm">
                                                ALL
                                            </button>
                                            <button type="button" class="btn btn-soft-secondary btn-sm">
                                                1M
                                            </button>
                                            <button type="button" class="btn btn-soft-secondary btn-sm">
                                                6M
                                            </button>
                                            <button type="button" class="btn btn-soft-primary btn-sm">
                                                1Y
                                            </button>
                                        </div>
                                    </div><!-- end card header -->

                                    <div class="card-header p-0 border-0 bg-light-subtle">
                                        <div class="row g-0 text-center">
                                            <div class="col-6 col-sm-3">
                                                <div class="p-3 border border-dashed border-start-0">
                                                    <h5 class="mb-1"><span class="counter-value" data-target="9851">0</span></h5>
                                                    <p class="text-muted mb-0">Number of Projects</p>
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-6 col-sm-3">
                                                <div class="p-3 border border-dashed border-start-0">
                                                    <h5 class="mb-1"><span class="counter-value" data-target="1026">0</span></h5>
                                                    <p class="text-muted mb-0">Active Projects</p>
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-6 col-sm-3">
                                                <div class="p-3 border border-dashed border-start-0">
                                                    <h5 class="mb-1">$<span class="counter-value" data-target="228.89">0</span>k</h5>
                                                    <p class="text-muted mb-0">Revenue</p>
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-6 col-sm-3">
                                                <div class="p-3 border border-dashed border-start-0 border-end-0">
                                                    <h5 class="mb-1 text-success"><span class="counter-value" data-target="10589">0</span>h</h5>
                                                    <p class="text-muted mb-0">Working Hours</p>
                                                </div>
                                            </div>
                                            <!--end col-->
                                        </div>
                                    </div><!-- end card header -->
                                    <div class="card-body p-0 pb-2">
                                        <div>
                                            <div id="projects-overview-chart" data-colors='["--vz-primary", "--vz-secondary", "--vz-danger"]' dir="ltr" class="apex-charts"></div>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div><!-- end col -->
                        </div><!-- end row -->
                    </div><!-- end col -->


                    <div class="col-xxl-4 col-lg-6">
                        <div class="card card-height-100">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Estado de los proyectos</h4>
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
                                </div>
                            </div><!-- end card header -->

                            <div class="card-body">
                                <div id="prjects-status" data-colors='["--vz-success", "--vz-info", "--vz-warning", "--vz-secondary"]' class="apex-charts" dir="ltr"></div>
                                <div class="mt-3">
                                    <div class="d-flex justify-content-center align-items-center mb-4">
                                        <h2 class="me-3 ff-secondary mb-0"><?php echo $totalProjects ?></h2>
                                        <div>
                                            <p class="text-muted mb-0">Total de proyectos</p>
                                            <!--<p class="text-success fw-medium mb-0">
                                                <span class="badge bg-success-subtle text-success p-1 rounded-circle"><i class="ri-arrow-right-up-line"></i></span> +3 New
                                            </p>-->
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between border-bottom border-bottom-dashed py-2">
                                        <p class="fw-medium mb-0"><i class="ri-checkbox-blank-circle-fill text-success align-middle me-2"></i> Completados</p>
                                        <div>
                                            <span class="text-muted pe-5">125 Projects</span>
                                            <span class="text-success fw-medium fs-12">15870hrs</span>
                                        </div>
                                    </div><!-- end -->
                                    <div class="d-flex justify-content-between border-bottom border-bottom-dashed py-2">
                                        <p class="fw-medium mb-0"><i class="ri-checkbox-blank-circle-fill text-primary align-middle me-2"></i> En progreso</p>
                                        <div>
                                            <span class="text-muted pe-5">42 Projects</span>
                                            <span class="text-success fw-medium fs-12">243hrs</span>
                                        </div>
                                    </div><!-- end -->
                                    <div class="d-flex justify-content-between border-bottom border-bottom-dashed py-2">
                                        <p class="fw-medium mb-0"><i class="ri-checkbox-blank-circle-fill text-warning align-middle me-2"></i> Iniciado</p>
                                        <div>
                                            <span class="text-muted pe-5">58 Projects</span>
                                            <span class="text-success fw-medium fs-12">~2050hrs</span>
                                        </div>
                                    </div><!-- end -->
                                    <div class="d-flex justify-content-between py-2">
                                        <p class="fw-medium mb-0"><i class="ri-checkbox-blank-circle-fill text-secondary align-middle me-2"></i> Cancelados</p>
                                        <div>
                                            <span class="text-muted pe-5">89 Projects</span>
                                            <span class="text-success fw-medium fs-12">~900hrs</span>
                                        </div>
                                    </div><!-- end -->
                                </div>
                            </div><!-- end cardbody -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                </div><!-- end row -->

                <div class="row">
                    <div class="col-xl-7">
                        <div class="card card-height-100">
                            <div class="card-header d-flex align-items-center">
                                <h4 class="card-title flex-grow-1 mb-0">Docentes</h4>

                                <div class="flex-shrink-0">
                                    <a href="javascript:void(0);" class="btn btn-soft-info btn-sm">Export Report</a>
                                </div>
                            </div><!-- end cardheader -->
                            <div class="card-body">

                                <div class="table-responsive table-card">

                                    <table class="table table-nowrap table-centered align-middle">

                                        <thead class="bg-light text-muted">
                                            <tr>
                                                <th scope="col">id</th>
                                                <th scope="col">Nombre</th>
                                                <th scope="col">Ingenieria</th>
                                                <th scope="col">capacitacion</th>
                                            </tr><!-- end tr -->
                                        </thead><!-- thead -->

                                        <tbody>
                                            <!-- For para mostrar los resultados obtenidos -->
                                            <?php foreach ($teachers as $teacher) { ?>
                                                <tr>
                                                    <!-- htmlspecialchars asegura que los datos se escapen adecuadamente para evitar vulnerabilidades XSS -->
                                                    <td class="fw-medium"><?php echo htmlspecialchars($teacher['id']); ?></td>
                                                    <td class="fw-medium"><?php echo htmlspecialchars($teacher['nombre']); ?></td>
                                                    <td class="fw-medium"><?php echo htmlspecialchars($teacher['nombre_ingenieria']); ?></td>
                                                    <td class="text-center">
                                                        <!-- Utiliza un operador ternario para validar si esta capacitado o no-->
                                                        <input type="checkbox" <?php echo ($teacher['capacitacion'] == 2) ? 'checked' : ''; ?> disabled>
                                                    </td>
                                                </tr><!-- end tr -->
                                            <?php } ?>
                                        </tbody><!-- end tbody -->

                                    </table><!-- end table -->

                                </div>

                                <!-- Paginacion -->

                                <div class="align-items-center mt-xl-3 mt-4 justify-content-between d-flex">
                                    <div class="flex-shrink-0">
                                        <div class="text-muted">Showing <span class="fw-semibold">5</span> of <span class="fw-semibold"><?php echo $totalTeachers; ?></span> Results </div>
                                    </div>
                                    <ul class="pagination pagination-separated pagination-sm mb-0">
                                        <!-- Botón anterior -->
                                        <li class="page-item <?php echo $paginationTeachers->page <= 0 ? 'disabled' : ''; // si la pagina es menor o igual a 0 se deshabilita el boton si no se habilita?>"> 
                                            <a href="<?php echo $paginationTeachers->createUrl($paginationTeachers->page - 1); ?>" class="page-link">←</a>
                                        </li>

                                        <!-- Números de página -->
                                        <?php for ($i = 0; $i < $paginationTeachers->pageCount; $i++) { ?>
                                            <li class="page-item <?php echo $paginationTeachers->page == $i ? 'active' : ''; ?>">
                                                <a href="<?php echo $paginationTeachers->createUrl($i); ?>" class="page-link"><?php echo $i + 1; ?></a>
                                            </li>
                                        <?php } ?>

                                        <!-- Botón siguiente -->
                                        <li class="page-item <?php echo $paginationTeachers->page >= $paginationTeachers->pageCount - 1 ? 'disabled' : ''; //Si la pagina es mayor o igual al numero de registros obtenidos de la consulta se deshabilita si no se habilita?>">
                                            <a href="<?php echo $paginationTeachers->createUrl($paginationTeachers->page + 1); ?>" class="page-link">→</a>
                                        </li>
                                    </ul>
                                </div>

                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-5">
                        <div class="card card-height-100">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1 py-1">My Tasks</h4>
                                <div class="flex-shrink-0">
                                    <div class="dropdown card-header-dropdown">
                                        <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="text-muted">All Tasks <i class="mdi mdi-chevron-down ms-1"></i></span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="#">All Tasks</a>
                                            <a class="dropdown-item" href="#">Completed </a>
                                            <a class="dropdown-item" href="#">Inprogress</a>
                                            <a class="dropdown-item" href="#">Pending</a>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end card header -->
                            <div class="card-body">
                                <div class="table-responsive table-card">
                                    <table class="table table-borderless table-nowrap table-centered align-middle mb-0">
                                        <thead class="table-light text-muted">
                                            <tr>
                                                <th scope="col">Name</th>
                                                <th scope="col">Deadline</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Assignee</th>
                                            </tr>
                                        </thead><!-- end thead -->
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input fs-15" type="checkbox" value="" id="checkTask1">
                                                        <label class="form-check-label ms-1" for="checkTask1">
                                                            Create new Admin Template
                                                        </label>
                                                    </div>
                                                </td>
                                                <td class="text-muted">03 Nov 2021</td>
                                                <td><span class="badge bg-success-subtle text-success">Completed</span></td>
                                                <td>
                                                    <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Mary Stoner">
                                                        <img src="administrador/images/users/avatar-2.jpg" alt="" class="rounded-circle avatar-xxs">
                                                    </a>
                                                </td>
                                            </tr><!-- end -->
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input fs-15" type="checkbox" value="" id="checkTask2">
                                                        <label class="form-check-label ms-1" for="checkTask2">
                                                            Marketing Coordinator
                                                        </label>
                                                    </div>
                                                </td>
                                                <td class="text-muted">17 Nov 2021</td>
                                                <td><span class="badge bg-warning-subtle text-warning">Progress</span></td>
                                                <td>
                                                    <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Den Davis">
                                                        <img src="administrador/images/users/avatar-7.jpg" alt="" class="rounded-circle avatar-xxs">
                                                    </a>
                                                </td>
                                            </tr><!-- end -->
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input fs-15" type="checkbox" value="" id="checkTask3">
                                                        <label class="form-check-label ms-1" for="checkTask3">
                                                            Administrative Analyst
                                                        </label>
                                                    </div>
                                                </td>
                                                <td class="text-muted">26 Nov 2021</td>
                                                <td><span class="badge bg-success-subtle text-success">Completed</span></td>
                                                <td>
                                                    <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Alex Brown">
                                                        <img src="administrador/images/users/avatar-6.jpg" alt="" class="rounded-circle avatar-xxs">
                                                    </a>
                                                </td>
                                            </tr><!-- end -->
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input fs-15" type="checkbox" value="" id="checkTask4">
                                                        <label class="form-check-label ms-1" for="checkTask4">
                                                            E-commerce Landing Page
                                                        </label>
                                                    </div>
                                                </td>
                                                <td class="text-muted">10 Dec 2021</td>
                                                <td><span class="badge bg-danger-subtle text-danger">Pending</span></td>
                                                <td>
                                                    <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Prezy Morin">
                                                        <img src="administrador/images/users/avatar-5.jpg" alt="" class="rounded-circle avatar-xxs">
                                                    </a>
                                                </td>
                                            </tr><!-- end -->
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input fs-15" type="checkbox" value="" id="checkTask5">
                                                        <label class="form-check-label ms-1" for="checkTask5">
                                                            UI/UX Design
                                                        </label>
                                                    </div>
                                                </td>
                                                <td class="text-muted">22 Dec 2021</td>
                                                <td><span class="badge bg-warning-subtle text-warning">Progress</span></td>
                                                <td>
                                                    <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Stine Nielsen">
                                                        <img src="administrador/images/users/avatar-1.jpg" alt="" class="rounded-circle avatar-xxs">
                                                    </a>
                                                </td>
                                            </tr><!-- end -->
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input fs-15" type="checkbox" value="" id="checkTask6">
                                                        <label class="form-check-label ms-1" for="checkTask6">
                                                            Projects Design
                                                        </label>
                                                    </div>
                                                </td>
                                                <td class="text-muted">31 Dec 2021</td>
                                                <td><span class="badge bg-danger-subtle text-danger">Pending</span></td>
                                                <td>
                                                    <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Jansh William">
                                                        <img src="administrador/images/users/avatar-4.jpg" alt="" class="rounded-circle avatar-xxs">
                                                    </a>
                                                </td>
                                            </tr><!-- end -->
                                        </tbody><!-- end tbody -->
                                    </table><!-- end table -->
                                </div>
                                <div class="mt-3 text-center">
                                    <a href="javascript:void(0);" class="text-muted text-decoration-underline">Load More</a>
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

<script src="theme/functionAjax/dashboardAjax.js"></script>