<?php

use backend\models\Notifications;
use yii\helpers\Html;
use yii\helpers\Url;

// Aquí creamos el formulario para cerrar sesión
$form = Html::beginForm(['/site/logout'], 'post', ['class' => 'd-none', 'id' => 'logout-form'])
    . Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken)
    . Html::endForm();
?>
<?php
use common\models\ValorHelpers;
use backend\models\UsuarioPermiso;
use yii\web\NotFoundHttpException;

$id_user = Yii::$app->user->identity->getId();
if ($id_user !== null) {
    // Buscar todos los permisos del usuario
    $userPermisos = UsuarioPermiso::findAll(['user_id' => $id_user]);

    if (!empty($userPermisos)) {
        // Definir permisos para coordinadores y avanzados
        $permisosCoordinadores = [
            'CoordinadorSistemas',
            'CoordinadorAdministracion',
            'CoordinadorCivil',
            'CoordinadorAmbiental',
            'CoordinadorIndustrial',
            'CoordinadorGestionEmpresarial',
        ];
        $permisosAvanzados = [
            'AdministradorDelSistema',
            'SuperUsuario',
        ];

        // Variable para controlar si ya se aplicó el filtro
        $filtroAplicado = false;

        // Crear la consulta de notificaciones
        $query = Notifications::find()->where(['is_read' => 0]);

        // Si el usuario tiene permiso, aplicar el filtro
        foreach ($userPermisos as $userPermiso) {
            $nombrePermiso = $userPermiso->permiso->permiso_nombre;

            if (in_array($nombrePermiso, $permisosCoordinadores)) {
                $userPermisoValor = ValorHelpers::getPermisoValor($nombrePermiso);
                $query->andFilterWhere(['=', 'ingenieria_id', $userPermisoValor]);
                $filtroAplicado = true;
                break; // Se aplicó un filtro, detener el ciclo
            }

            if (in_array($nombrePermiso, $permisosAvanzados)) {
                $filtroAplicado = true; // Usuario avanzado, no se aplica filtro adicional
                break;
            }
        }

        // Si no se aplicó ningún filtro, lanzar excepción
        if (!$filtroAplicado) {
            throw new NotFoundHttpException('Necesitas otro tipo de permiso para esta acción.');
        }

        // Ejecutar la consulta con el filtro aplicado
        $notifications = $query
            ->orderBy(['created_at' => SORT_DESC])
            ->limit(5)
            ->all();

        $unreadCount = $query->count();

    } else {
        throw new NotFoundHttpException('El usuario no tiene un permiso asignado.');
    }
} else {
    throw new NotFoundHttpException('Necesitas permisos para esta acción.');
}

// Cambiar zona horaria
Yii::$app->timeZone = 'America/Mexico_City';

// Función para calcular tiempo transcurrido
function timeAgo($timestamp) {
    $time_ago = strtotime($timestamp);
    $current_time = time();
    $time_difference = $current_time - $time_ago;

    if ($time_difference < 60) {
        return "Justo ahora";
    } else if ($time_difference < 3600) {
        $minutes = floor($time_difference / 60);
        return "$minutes min ago";
    } else if ($time_difference < 86400) {
        $hours = floor($time_difference / 3600);
        return "$hours hrs ago";
    } else if ($time_difference < 2592000) {
        $days = floor($time_difference / 86400);
        return "$days days ago";
    } else if ($time_difference < 31536000) {
        $months = floor($time_difference / 2592000);
        return "$months months ago";
    } else {
        $years = floor($time_difference / 31536000);
        return "$years years ago";
    }
}
?>

<header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box horizontal-logo">
                    <a href="index" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="theme/images/logo-sm.png" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="theme/images/logo-dark.png" alt="" height="17">
                        </span>
                    </a>

                    <a href="index" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="theme/images/logo-sm.png" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="theme/images/logo-light.png" alt="" height="17">
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger" id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>


            </div>

            <div class="d-flex align-items-center">

                <div class="dropdown d-md-none topbar-head-dropdown header-item">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="bx bx-search fs-22"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-search-dropdown">
                        <form class="p-3">
                            <div class="form-group m-0">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                    <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" data-toggle="fullscreen">
                        <i class='bx bx-fullscreen fs-22'></i>
                    </button>
                </div>

                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode">
                        <i class='bx bx-moon fs-22'></i>
                    </button>
                </div>

                <div class="dropdown topbar-head-dropdown ms-1 header-item" id="notificationDropdown">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
                        <i class='bx bx-bell fs-22'></i>
                        <span class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger"><?= $unreadCount?><span class="visually-hidden">unread messages</span></span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">

                        <div class="dropdown-head bg-primary bg-pattern rounded-top">
                            <div class="p-3">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="m-0 fs-16 fw-semibold text-white"> Notificationes </h6>
                                    </div>
                                    <div class="col-auto dropdown-tabs">
                                        <span class="badge bg-light-subtle text-body fs-13"><?= $unreadCount?> New</span>
                                    </div>
                                </div>
                            </div>

                            <div class="px-2 pt-2">
                                <ul class="nav nav-tabs dropdown-tabs nav-tabs-custom" data-dropdown-tabs="true" id="notificationItemsTab" role="tablist">
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link" data-bs-toggle="tab" href="#messages-tab" role="tab" aria-selected="false">
                                            Mensajes
                                        </a>
                                    </li>
                                </ul>
                            </div>

                        </div>

                        <div class="tab-content position-relative" id="notificationItemsTabContent">
                            <div class="tab-pane fade show active py-2 ps-2" id="all-noti-tab" role="tabpanel">
                                <div data-simplebar style="max-height: 300px;" class="pe-2">
                                    <?php if (!empty($notifications)): ?>
                                        <?php foreach ($notifications as $notification): ?>
                            <div class="text-reset notification-item d-block dropdown-item position-relative">
                                <div class="d-flex">
                                    <div class="avatar-xs me-3 flex-shrink-0">
                                        <span class="avatar-title bg-info-subtle text-info rounded-circle fs-16">
                                            <i class="bx bx-badge-check"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1">
                                        <a href="#!" class="stretched-link">
                                            <h6 class="mt-0 mb-2 lh-base"><b><?= htmlspecialchars($notification->title, ENT_QUOTES) ?></b></br>
                                                <span class="text-secondary"><?= htmlspecialchars($notification->content, ENT_QUOTES) ?></span>
                                            </h6>
                                        </a>
                                        <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                            <span><i class="mdi mdi-clock-outline"></i> <?= timeAgo($notification->created_at) ?></span>
                                        </p>
                                    </div>
                                    <div class="px-2 fs-15">
                                        <div class="form-check notification-check">
                                            <input class="form-check-input" type="checkbox" value="" id="all-notification-check01">
                                            <label class="form-check-label" for="all-notification-check01"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                                    <?php else: ?>
                                        <div class="text-center text-muted py-3">
                                            <i class="mdi mdi-bell-off-outline fs-24"></i>
                                            <p class="mb-0">No hay notificaciones nuevas</p>
                                        </div>
                                    <?php endif; ?>


                                    <div class="my-3 text-center view-all">
                                        <a href="<?= \yii\helpers\Url::to(['notifications/index']) ?>" class="btn btn-soft-success waves-effect waves-light">
                                            View All Notifications <i class="ri-arrow-right-line align-middle"></i>
                                        </a>
                                    </div>

                                </div>

                            </div>

                            <div class="tab-pane fade p-4" id="alerts-tab" role="tabpanel" aria-labelledby="alerts-tab"></div>

                            <div class="notification-actions" id="notification-actions">
                                <div class="d-flex text-muted justify-content-center">
                                    Select <div id="select-content" class="text-body fw-semibold px-1">0</div> Result <button type="button" class="btn btn-link link-danger p-0 ms-3" data-bs-toggle="modal" data-bs-target="#removeNotificationModal">Remove</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="dropdown ms-sm-3 header-item topbar-user">
                    <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <img class="rounded-circle header-profile-user" src="theme/images/users/avatar-1.jpg" alt="Header Avatar">
                            <span class="text-start ms-xl-2">
                                <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text"><?= Yii::$app->user->identity->username ?></span>
                                <span class="d-none d-xl-block ms-1 fs-12 user-name-sub-text">Admin</span>
                            </span>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <h6 class="dropdown-header">Bienvenido <?= Yii::$app->user->identity->username ?>!</h6>
                        <a class="dropdown-item" href="pages-profile"><i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Perfil</span></a>
                        <a class="dropdown-item" href="pages-faqs"><i class="mdi mdi-lifebuoy text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Ayuda</span></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="pages-profile-settings"><span class="badge bg-success-subtle text-success mt-1 float-end">New</span><i class="mdi mdi-cog-outline text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Configuracion</span></a>
                        <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i>
                            <span class="align-middle" data-key="t-logout">Cerrar Sesión</span>
                        </a>

                        <!-- Incluye el formulario oculto para la solicitud de cierre de sesión -->
                        <?= $form ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- removeNotificationModal -->
<div id="removeNotificationModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="NotificationModalbtn-close"></button>
            </div>
            <div class="modal-body">
                <div class="mt-2 text-center">
                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                    <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                        <h4>Are you sure ?</h4>
                        <p class="text-muted mx-4 mb-0">Are you sure you want to remove this Notification ?</p>
                    </div>
                </div>
                <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                    <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn w-sm btn-danger" id="delete-notification">Yes, Delete It!</button>
                </div>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>