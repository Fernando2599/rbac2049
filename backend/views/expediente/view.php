<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var common\models\Expediente $model */

$this->title = 'Expediente: ' . $model->perfilEstudiante->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Estudiantes Duales', 'url' => ['perfil-estudiante/index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="expediente-view">

    <h4><?= Html::encode($this->title) ?></h4>

    <?php if ($model->estado_expediente_id == 1) { ?>

        <p>
            <?= Html::a('Cerrar expediente', ['update', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => '¿Está seguro que desea cerrar el expediente?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>

    <?php
    } else if ($model->estado_expediente_id == 2) { ?>

        <p>
            <?= Html::a('Reabrir expediente', ['reabrir', 'id' => $model->id], [
                'class' => 'btn btn-success',
                'data' => [
                    'confirm' => '¿Está seguro que desea volver a abrir el expediente?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>

    <?php
    } else if ($model->estado_expediente_id == 3) {

        echo '<div class="alert alert-success alert-dismissible alert-label-icon label-arrow fade show" role="alert">
                <i class="ri-check-double-line label-icon"></i><strong>Alerta</strong> Este expediente ha completado todo el proceso del Modelo Dual
            </div>';
    }

    ?>

    <?php if ($model->estado_expediente_id == 1) { ?>

        <div class="col-xxl-12">

            <div class="card">

                <div class="card-body">

                    <h6 class="mb-3 fs-15 fw-semibold text-uppercase">Detalles</h6>

                    <div class="row">

                        <div class="col-lg-3 col-sm-6">

                            <div>
                                <p class="mb-2 text-uppercase fw-medium">Fecha de creación :</p>
                                <h5 class="fs-15 mb-0"><?= $model->created_at ?></h5>
                            </div>

                        </div>

                        <div class="col-lg-3 col-sm-6">

                            <div>
                                <p class="mb-2 text-uppercase fw-medium">Fecha de creación :</p>
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
                                if ($model->estado_expediente_id == 1) {
                                    $badgeClass = 'bg-info'; // Clase para el estado "Success"
                                } elseif ($model->estado_expediente_id == 2) {
                                    $badgeClass = 'bg-danger'; // Clase para el estado "Warning"
                                } elseif ($model->estado_expediente_id == 3) {
                                    $badgeClass = 'bg-success'; // Clase para el estado "Danger"
                                }
                                ?>

                                <div class="badge <?= $badgeClass ?> fs-12"><?= $model->estadoExpediente->nombre ?></div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>



    <?php
    } else if ($model->estado_expediente_id == 2 || $model->estado_expediente_id == 3) { ?>

        <div class="col-xxl-12">

            <div class="card">

                <div class="card-body">

                    <h6 class="mb-3 fs-15 fw-semibold text-uppercase">Detalles</h6>

                    <div class="row">

                        <div class="col-lg-2 col-sm-4">

                            <div>
                                <p class="mb-2 text-uppercase fw-medium">Fecha de creación :</p>
                                <h5 class="fs-15 mb-0"><?= $model->created_at ?></h5>
                            </div>

                        </div>

                        <div class="col-lg-2 col-sm-4">

                            <div>
                                <p class="mb-2 text-uppercase fw-medium">Fecha de cierre :</p>
                                <h5 class="fs-15 mb-0"><?= $model->fecha_cierre ?></h5>
                            </div>

                        </div>

                        <div class="col-lg-2 col-sm-4">

                            <div>
                                <p class="mb-2 text-uppercase fw-medium">Última actualización :</p>
                                <h5 class="fs-15 mb-0"><?= $model->updated_at ?></h5>
                            </div>

                        </div>

                        <div class="col-lg-2 col-sm-4">
                            <!--bloque de codigo que valida el estado del preregistro para cambiar dinamicamente los estilos del badge-->
                            <div>
                                <p class="mb-2 text-uppercase fw-medium">Estado :</p>
                                <?php
                                $badgeClass = 'bg-info'; // Clase predeterminada para el badge

                                // Verificar el valor de estadoRegistro->id y asignar la clase correspondiente al badge
                                if ($model->estado_expediente_id == 1) {
                                    $badgeClass = 'bg-info'; // Clase para el estado "info"
                                } elseif ($model->estado_expediente_id == 2) {
                                    $badgeClass = 'bg-danger'; // Clase para el estado "danger"
                                } elseif ($model->estado_expediente_id == 3) {
                                    $badgeClass = 'bg-success'; // Clase para el estado "success"
                                }
                                ?>

                                <div class="badge <?= $badgeClass ?> fs-12"><?= $model->estadoExpediente->nombre ?></div>
                            </div>
                        </div>

                        <div class="col-lg-2 col-sm-4">
                            <!--bloque de codigo que valida el estado del preregistro para cambiar dinamicamente los estilos del badge-->
                            <div>
                                <p class="mb-2 text-uppercase fw-medium">Motivo de cierre :</p>
                                <?php
                                $badgeClass = 'bg-info'; // Clase predeterminada para el badge

                                // Verificar el valor de estadoRegistro->id y asignar la clase correspondiente al badge
                                if ($model->motivoCierre->id == 1) {
                                    $badgeClass = 'bg-info'; // Clase para el estado "info"
                                } elseif ($model->motivoCierre->id == 2 || $model->motivoCierre->id == 3) {
                                    $badgeClass = 'bg-danger'; // Clase para el estado "danger"
                                } elseif ($model->motivoCierre->id == 4) {
                                    $badgeClass = 'bg-success'; // Clase para el estado "success"
                                }
                                ?>

                                <div class="badge <?= $badgeClass ?> fs-12"><?= $model->motivoCierre->nombre ?></div>
                            </div>
                        </div>

                    </div>

                    <div class="row m-3">

                        <div class="col-sm-12">
                            <li class="fs-15 mb-0 fw-semibold"> Comentario: <span class="fw-normal"> <?= $model->comentario ?> </span> </li>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    <?php
    }
    ?>

    <h4>Documentos Entregados</h4>

    <div class="card">

        <div class="card-body">

            <div class="table-responsive">

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'tableOptions' => ['class' => 'table align-middle mb-0'],
                    'headerRowOptions' => ['class' => 'table-light'],
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        //'documento_id'
                        ['label' => 'Documento', 'value' => function ($searchModel) {
                            return $searchModel->documento->nombre;
                        }],
                        //'expediente_id',
                        [
                            'attribute' => 'ruta',
                            'format' => 'html',
                            'value' => function ($model) {
                                return Html::a(basename($model->ruta), ['file', 'filename' => $model->ruta]);
                            }
                        ],
                        'created_at:datetime',
                        'updated_at:datetime',
                        //'comentario:ntext',
                        ['class' => 'yii\grid\ActionColumn', 'controller' => 'documento-expediente', 'template' => '{view}'],
                    ],
                ]); ?>

            </div>

        </div>

    </div>


</div>