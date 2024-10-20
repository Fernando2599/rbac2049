<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Preregistro $model */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Preregistros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="preregistro-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    if ($model->estado_registro_id == 4) {
        echo '<div class="alert alert-success alert-dismissible alert-label-icon label-arrow fade show" role="alert">
                <i class="ri-check-double-line label-icon"></i><strong>Alerta</strong> Este alumno ya fue aprobado
            </div>';
    } else { ?>

        <p>
            <?= Html::a('Actualizar estado', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        </p>

    <?php
    }
    ?>

    <div class="col-xxl-12">

        <div class="card">

            <div class="card-body">

                <h6 class="mb-3 fs-15 fw-semibold text-uppercase">Detalles</h6>

                <div class="row mb-3">

                    <div class="col-md-6">

                        <ul class="ps-4 vstack gap-2 d-flex ">

                            <li class="fs-15 mb-0 fw-semibold"> Nombre: <span class="fw-normal"> <?= $model->nombre ?> </span> </li>

                            <li class="fs-15 mb-0 fw-semibold"> Ingenieria: <span class="fw-normal"> <?= $model->ingenieria->nombre ?> </span> </li>

                        </ul>

                    </div>

                    <div class="col-md-6">

                        <ul class="ps-4 vstack gap-2 d-flex ">

                            <li class="fs-15 mb-0 fw-semibold"> Matricula: <span class="fw-normal"> <?= $model->matricula ?> </span> </li>

                            <li class="fs-15 mb-0 fw-semibold"> Correo: <span class="fw-normal"> <?= $model->email ?> </span> </li>

                        </ul>

                    </div>

                </div>

                <div class="row mb-3">

                    <ul class="ps-4 vstack gap-2 d-flex ">

                        <li class="fs-15 mb-0 fw-semibold"> Comentario: <span class="fw-normal"> <?= $model->comentario ?> </span> </li>

                    </ul>

                </div>

                <div class="pt-3 border-top border-top-dashed mt-4">

                    <div class="row">

                        <div class="col-lg-3 col-sm-6">

                            <div>
                                <p class="mb-2 text-uppercase fw-medium">Fecha de creación :</p>
                                <h5 class="fs-15 mb-0"><?= $model->created_at ?></h5>
                            </div>

                        </div>

                        <div class="col-lg-3 col-sm-6">

                            <div>
                                <p class="mb-2 text-uppercase fw-medium">Ultima actualización : </p>
                                <h5 class="fs-15 mb-0"><?= $model->updated_at ?></h5>
                            </div>

                        </div>


                        <div class="col-lg-3 col-sm-6">
                            <!--bloque de codigo que valida el estado del preregistro para cambiar dinamicamente los estilos del badge-->
                            <div>
                                <p class="mb-2 text-uppercase fw-medium">Estado :</p>
                                <?php
                                $badgeClass = 'bg-info'; // Clase predeterminada para el badge

                                // Verificar el valor de estadoRegistro->id y asignar la clase correspondiente al badge
                                if ($model->estadoRegistro->id == 1) {
                                    $badgeClass = 'bg-info'; // Clase para el estado "Success"
                                } elseif ($model->estadoRegistro->id == 2) {
                                    $badgeClass = 'bg-warning'; // Clase para el estado "Warning"
                                } elseif ($model->estadoRegistro->id == 3) {
                                    $badgeClass = 'bg-danger'; // Clase para el estado "Danger"
                                } elseif ($model->estadoRegistro->id == 4) {
                                    $badgeClass = 'bg-success'; // Clase para el estado "Danger"
                                }
                                ?>

                                <div class="badge <?= $badgeClass ?> fs-12"><?= $model->estadoRegistro->nombre ?></div>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="pt-3 border-top border-top-dashed mt-4">

                    <h6 class="mb-3 fw-semibold text-uppercase">Archivos</h6>

                    <div class="row g-3">

                        <div class="col-xxl-3 col-lg-4">

                            <div class="border rounded border-dashed p-2">

                                <div class="d-flex align-items-center">

                                    <div class="flex-shrink-0 me-3">

                                        <div class="avatar-sm">

                                            <div class="avatar-title bg-light text-secondary rounded fs-24">
                                                <i class="ri-folder-zip-line"></i>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="flex-grow-1 overflow-hidden">

                                        <p class="mb-2 text-uppercase fw-medium">Kardex:</p>
                                        <h5 class="fs-13 mb-1">
                                            <?= Html::a(basename($model->kardex), ['file', 'filename' => $model->kardex], ['class' => 'text-body text-truncate d-block']) ?>
                                        </h5>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-xxl-3 col-lg-4">

                            <div class="border rounded border-dashed p-2">

                                <div class="d-flex align-items-center">

                                    <div class="flex-shrink-0 me-3">

                                        <div class="avatar-sm">

                                            <div class="avatar-title bg-light text-secondary rounded fs-24">
                                                <i class="ri-folder-zip-line"></i>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="flex-grow-1 overflow-hidden">

                                        <p class="mb-2 text-uppercase fw-medium">Contancia de ingles:</p>
                                        <h5 class="fs-13 mb-1">
                                            <?= Html::a(basename($model->constancia_ingles), ['file', 'filename' => $model->constancia_ingles], ['class' => 'text-body text-truncate d-block']) ?>
                                        </h5>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-xxl-3 col-lg-4">

                            <div class="border rounded border-dashed p-2">

                                <div class="d-flex align-items-center">

                                    <div class="flex-shrink-0 me-3">

                                        <div class="avatar-sm">

                                            <div class="avatar-title bg-light text-secondary rounded fs-24">
                                                <i class="ri-folder-zip-line"></i>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="flex-grow-1 overflow-hidden">

                                        <p class="mb-2 text-uppercase fw-medium">Constancia de creditos complementarios:</p>
                                        <h5 class="fs-13 mb-1">
                                            <?= Html::a(basename($model->constancia_creditos_complementarios), ['file', 'filename' => $model->constancia_creditos_complementarios], ['class' => 'text-body text-truncate d-block']) ?>
                                        </h5>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-xxl-3 col-lg-4">

                            <div class="border rounded border-dashed p-2">

                                <div class="d-flex align-items-center">

                                    <div class="flex-shrink-0 me-3">

                                        <div class="avatar-sm">

                                            <div class="avatar-title bg-light text-secondary rounded fs-24">
                                                <i class="ri-folder-zip-line"></i>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="flex-grow-1 overflow-hidden">

                                        <p class="mb-2 text-uppercase fw-medium">cv:</p>
                                        <h5 class="fs-13 mb-1">
                                            <?= Html::a(basename($model->cv), ['file', 'filename' => $model->cv], ['class' => 'text-body text-truncate d-block']) ?>
                                        </h5>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-xxl-3 col-lg-4">

                            <div class="border rounded border-dashed p-2">

                                <div class="d-flex align-items-center">

                                    <div class="flex-shrink-0 me-3">

                                        <div class="avatar-sm">

                                            <div class="avatar-title bg-light text-secondary rounded fs-24">
                                                <i class="ri-folder-zip-line"></i>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="flex-grow-1 overflow-hidden">

                                        <p class="mb-2 text-uppercase fw-medium">Seguro Medico:</p>
                                        <h5 class="fs-13 mb-1">
                                            <?= Html::a(basename($model->seguro_medico), ['file', 'filename' => $model->seguro_medico], ['class' => 'text-body text-truncate d-block']) ?>
                                        </h5>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>