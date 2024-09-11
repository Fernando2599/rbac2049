<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\DocumentoExpediente $model */

$this->title = 'Detalles del documento';
$this->params['breadcrumbs'][] = ['label' => 'Estudiantes Duales', 'url' => ['perfil-estudiante/index']];
$this->params['breadcrumbs'][] = ['label' => 'Expediente', 'url' => ['expediente/view', 'id' => $model->expediente_id]];
$this->params['breadcrumbs'][] = $this->title;
//$this->params['breadcrumbs'][] = ['label' => 'Documento Expedientes', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="documento-expediente-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Añadir un comentario', ['update', 'documento_id' => $model->documento_id, 'expediente_id' => $model->expediente_id], ['class' => 'btn btn-primary']) ?>
    </p>

    <div class="col-xxl-12">

        <div class="card">

            <div class="card-body">

                <h6 class="mb-3 fs-15 fw-semibold text-uppercase">Detalles</h6>

                <div class="row">

                    <div class="col-sm-6">

                        <ul class="ps-4 vstack gap-2 d-flex ">

                            <li class="fs-15 mb-0 fw-semibold"> Nombre del documento: <span class="fw-normal"> <?= $model->documento->nombre ?> </span> </li>
                            <li class="fs-15 mb-0 fw-semibold"> Comentario: <span class="fw-normal"> <?= $model->comentario ?> </span> </li>

                        </ul>

                    </div>

                    <div class="col-sm-4">

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

                                    <p class="mb-2 text-uppercase fw-medium">Archivo:</p>
                                    <h5 class="fs-13 mb-1">
                                        <?= Html::a(basename($model->ruta), ['file', 'filename' => $model->ruta], ['class' => 'text-body text-truncate d-block']) ?>
                                    </h5>

                                </div>

                            </div>

                        </div>
                    </div>

                </div>

                <ul class="ps-4 vstack gap-2 d-flex ">



                </ul>
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

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>