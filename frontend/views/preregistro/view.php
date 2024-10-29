<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var common\models\Preregistro $model */

$this->title = $model->matricula;
$this->params['breadcrumbs'][] = ['label' => 'Preregistros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="page-content" style="padding: 70px 45px 50px;">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php
        if ($model->estado_registro_id == 2) { ?>
            <?= Html::a('Modificar información', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php }
        if ($model->estado_registro_id != 3 && $model->estado_registro_id != 4) { ?>
            <?= Html::a('Eliminar Pre-registro', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => '¿Está seguro que desea eliminar su pre-registro?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php } ?>
    </p>

    <?php
    if ($model->estado_registro_id == 4) {
        echo '<div class="alert alert-success alert-border-left show" role="alert">
                <i class="ri-check-double-line me-3 align-middle"></i> <strong>¡Felicidades!</strong> - Tu registro al Modelo Dual fue aprobado.
            </div>';
    } ?>

    <?php
    if ($model->estado_registro_id == 3) {
        echo '<div class="alert alert-danger alert-border-left show" role="alert">
                    <i class="ri-error-warning-line me-3 align-middle"></i> <strong>Desafortunadamente</strong> - Tu registro al Modelo Dual NO fue aprobado.
                </div>';
    } ?>

    <div class="row">
        <div class="col-xl-12 col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="text-muted">
                        <h6 class="mb-3 text-uppercase">Informacion de pre-registro</h6>
                        <div class="row">
                            <div class="col-sm-6">
                                <ul class="ps-4 vstack gap-2">
                                    <li class="fs-15 mb-0 fw-semibold">Nombre</li>
                                    <li class="fs-15 mb-0 fw-semibold">Matricula</li>
                                    <li class="fs-15 mb-0 fw-semibold">Correo</li>
                                    <li class="fs-15 mb-0 fw-semibold">Ingenieria</li>
                                    <li class="fs-15 mb-0 fw-semibold">Comentario</li>
                                </ul>
                            </div>
                            <div class="col-sm-6">
                                <ul class="ps-4 vstack gap-2">
                                    <p class="m-0"><?= $model->nombre ?></p>
                                    <p class="m-0"><?= $model->matricula ?></p>
                                    <p class="m-0"><?= $model->email ?></p>
                                    <p class="m-0"><?= $model->ingenieria->nombre ?></p>
                                    <p class="m-0"><?= $model->comentario ?></p>
                                </ul>
                            </div>
                        </div>


                        <div class="pt-3 border-top border-top-dashed mt-4">
                            <div class="row d-flex justify-content-center align-items-center">

                                <div class="col-lg-3 col-sm-6">
                                    <div>
                                        <p class="mb-2 text-uppercase fw-medium">Fecha de creación:</p>
                                        <h5 class="fs-14 mb-0"><?= $model->created_at ?></h5>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div>
                                        <p class="mb-2 text-uppercase fw-medium">Ultima actualización:</p>
                                        <h5 class="fs-14 mb-0"><?= $model->updated_at ?></h5>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div>
                                        <p class="mb-2 text-uppercase fw-medium">Estado :</p>

                                        <?php
                                        $badgeClass = 'bg-info'; // Clase predeterminada para el badge

                                        // Verificar el valor de estadoProyecto->id y asignar la clase correspondiente al badge
                                        if ($model->estadoRegistro->id == 1) {
                                            $badgeClass = 'bg-info'; // Clase para el estado "Success"
                                        } elseif ($model->estadoRegistro->id == 2) {
                                            $badgeClass = 'bg-warning'; // Clase para el estado "Warning"
                                        } elseif ($model->estadoRegistro->id == 3) {
                                            $badgeClass = 'bg-danger'; // Clase para el estado "Danger"
                                        } else if ($model->estadoRegistro->id == 4) {
                                            $badgeClass = 'bg-success';
                                        }
                                        ?>

                                        <div class="badge <?= $badgeClass ?> fs-12"><?= $model->estadoRegistro->nombre ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pt-3 border-top border-top-dashed mt-4">
                            <h6 class="mb-3 fw-semibold text-uppercase">Archivos subidos</h6>
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
                                                <?php

                                                $filename = basename($model->kardex); // Nombre del archivo
                                                $downloadUrl = ['download', 'filename' => $model->kardex]; // URL de descarga
                                                $filesize = Yii::$app->formatter->asShortSize(filesize($model->kardex)); // Tamaño del archivo

                                                ?>
                                                <h5 class="fs-13 mb-1"><?= Html::a($filename, $downloadUrl, ['class' => 'text-body text-truncate d-block']) ?></h5>
                                                <div><?= $filesize ?></div>
                                            </div>
                                            <div class="flex-shrink-0 ms-2">
                                                <div class="d-flex gap-1">
                                                    <button type="button" class="btn btn-icon text-muted btn-sm fs-18" onclick="window.location.href='<?= Url::to(['download', 'filename' => $model->kardex]) ?>'">
                                                        <i class="ri-download-2-line"></i>
                                                    </button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end col -->
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
                                                <?php

                                                $filename = basename($model->constancia_ingles); // Nombre del archivo
                                                $downloadUrl = ['download', 'filename' => $model->constancia_ingles]; // URL de descarga
                                                $filesizeConstancia = Yii::$app->formatter->asShortSize(filesize($model->constancia_ingles)); // Tamaño del archivo

                                                ?>
                                                <h5 class="fs-13 mb-1"><?= Html::a($filename, $downloadUrl, ['class' => 'text-body text-truncate d-block']) ?></h5>
                                                <div><?= $filesizeConstancia ?></div>
                                            </div>
                                            <div class="flex-shrink-0 ms-2">
                                                <div class="d-flex gap-1">
                                                    <button type="button" class="btn btn-icon text-muted btn-sm fs-18" onclick="window.location.href='<?= Url::to(['download', 'filename' => $model->constancia_ingles]) ?>'">
                                                        <i class="ri-download-2-line"></i>
                                                    </button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end col -->
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
                                                <?php

                                                $filename = basename($model->constancia_creditos_complementarios); // Nombre del archivo
                                                $downloadUrl = ['download', 'filename' => $model->constancia_creditos_complementarios]; // URL de descarga
                                                $filesizeCreditos = Yii::$app->formatter->asShortSize(filesize($model->constancia_creditos_complementarios)); // Tamaño del archivo

                                                ?>
                                                <h5 class="fs-13 mb-1"><?= Html::a($filename, $downloadUrl, ['class' => 'text-body text-truncate d-block']) ?></h5>
                                                <div><?= $filesizeCreditos ?></div>
                                            </div>
                                            <div class="flex-shrink-0 ms-2">
                                                <div class="d-flex gap-1">
                                                    <button type="button" class="btn btn-icon text-muted btn-sm fs-18" onclick="window.location.href='<?= Url::to(['download', 'filename' => $model->constancia_creditos_complementarios]) ?>'">
                                                        <i class="ri-download-2-line"></i>
                                                    </button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end col -->
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
                                                <?php

                                                $filename = basename($model->cv); // Nombre del archivo
                                                $downloadUrl = ['download', 'filename' => $model->cv]; // URL de descarga
                                                $filesizeCv = Yii::$app->formatter->asShortSize(filesize($model->cv)); // Tamaño del archivo

                                                ?>
                                                <h5 class="fs-13 mb-1"><?= Html::a($filename, $downloadUrl, ['class' => 'text-body text-truncate d-block']) ?></h5>
                                                <div><?= $filesizeCv ?></div>
                                            </div>
                                            <div class="flex-shrink-0 ms-2">
                                                <div class="d-flex gap-1">
                                                    <button type="button" class="btn btn-icon text-muted btn-sm fs-18" onclick="window.location.href='<?= Url::to(['download', 'filename' => $model->cv]) ?>'">
                                                        <i class="ri-download-2-line"></i>
                                                    </button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end col -->
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
                                                <?php

                                                $filename = basename($model->seguro_medico); // Nombre del archivo
                                                $downloadUrl = ['download', 'filename' => $model->seguro_medico]; // URL de descarga
                                                $filesizeSeguro = Yii::$app->formatter->asShortSize(filesize($model->seguro_medico)); // Tamaño del archivo

                                                ?>
                                                <h5 class="fs-13 mb-1"><?= Html::a($filename, $downloadUrl, ['class' => 'text-body text-truncate d-block']) ?></h5>
                                                <div><?= $filesizeSeguro ?></div>
                                            </div>
                                            <div class="flex-shrink-0 ms-2">
                                                <div class="d-flex gap-1">
                                                    <button type="button" class="btn btn-icon text-muted btn-sm fs-18" onclick="window.location.href='<?= Url::to(['download', 'filename' => $model->seguro_medico]) ?>'">
                                                        <i class="ri-download-2-line"></i>
                                                    </button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end col -->

                            </div>
                            <!-- end row -->
                        </div>
                    </div>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- ene col -->

    </div>

</div>