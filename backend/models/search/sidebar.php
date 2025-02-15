<?php

/** @var yii\web\View $this */
/** @var string $content */

use yii\helpers\Url;

?>

<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <!-- Dark Logo-->
                <a href="/" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="administrador/images/logo-sm.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="administrador/images/logo-dark.png" alt="" height="17">
                    </span>
                </a>
                <!-- Light Logo-->
                <a href="/" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="administrador/images/logo-sm.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="administrador/images/logo-light.png" alt="" height="17">
                    </span>
                </a>
                <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
                    <i class="ri-record-circle-line"></i>
                </button>
            </div>

            <div id="scrollbar">
                <div class="container-fluid">

                    <div id="two-column-menu">
                    </div>
                    <ul class="navbar-nav" id="navbar-nav">
                        <li class="menu-title"><span data-key="t-menu">Menu</span></li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="<?= Url::to(['/site']); ?>">
                                <i class="ri-dashboard-2-line"></i> <span data-key="t-site">Panel de control</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="<?= Url::to(['/admin']); ?>">
                                <i class="ri-user-line"></i> <span data-key="t-admin">Administrar usuarios</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="<?= Url::to(['/proyecto']); ?>">
                                <i class="ri-file-list-3-line"></i> <span data-key="t-proyecto">Proyectos</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarInstitution" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarInstitution">
                                <i class="las la-graduation-cap"></i> <span data-key="t-institution">Institucion</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarInstitution">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="" class="nav-link" data-key="t-api-key">Departamentos</a>
                                        <a href="<?= Url::to(['/asesor-interno']); ?>" class="nav-link" data-key="t-asesor-interno">Asesor Interno</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarEmpresa" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarEmpresa">
                                <i class="las la-briefcase"></i> <span data-key="t-Empresa">Empresa</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarEmpresa">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="<?= Url::to(['/empresa']); ?>" class="nav-link" data-key="t-Empresas">Empresas</a>
                                        <a href="<?= Url::to(['/asesor-externo']); ?>" class="nav-link" data-key="t-asesor-interno">Asesor Externo</a>
                                    </li>
                                </ul>
                            </div>
                        </li> <!-- end Dashboard Menu -->

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarIngenieria" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarIngenieria">
                                <i class="ri-honour-line"></i> <span data-key="t-forms">Ingenieria</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarIngenieria">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="<?= Url::to(['/especialidad']); ?>" class="nav-link" data-key="t-espacialidad">Especialidad</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="forms-select" class="nav-link" data-key="t-form-select">Plan de estudio</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= Url::to(['/asignatura']); ?>" class="nav-link" data-key="t-asignatura">Asignatura</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarAlumnos" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAlumnos">
                                <i class="las la-user-graduate"></i> <span data-key="t-tables">Alumnos</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarAlumnos">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="<?= Url::to(['/preregistro']); ?>" class="nav-link" data-key="t-preregistro">Pre-registros</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= Url::to(['/documento']); ?>" class="nav-link" data-key="t-documento">Documentos</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= Url::to(['/expediente']); ?>" class="nav-link" data-key="t-expediente">Expedientes</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                    </ul>
                </div>
                <!-- Sidebar -->
            </div>

            <div class="sidebar-background"></div>
        </div>
        <!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>