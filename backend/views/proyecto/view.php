<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use common\models\Asignatura;
use yii\helpers\Url;
use yii\grid\ActionColumn;

/** @var yii\web\View $this */
/** @var common\models\Proyecto $model */
$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Proyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="proyecto-view">

    <h1></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="bg-primary-subtle">
                    <div class="card-body pb-0 px-4">
                        <div class="row mb-3">
                            <div class="col-md">
                                <div class="row align-items-center g-3">
                                    <div class="col-md">
                                        <div>
                                            <h4 class="fw-bold"><?= Html::encode($this->title) ?></h4>
                                            <div class="hstack gap-3 flex-wrap">
                                                <div>Fecha de creación : <span class="fw-medium"><?= $model->created_at ?></span></div>
                                                <div class="vr"></div>
                                                <div>Ultima actualización : <span class="fw-medium"><?= $model->updated_at ?></span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <ul class="nav nav-tabs-custom border-bottom-0" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active fw-semibold" data-bs-toggle="tab" href="#project-overview" role="tab">
                                    Descripcion General
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-semibold" data-bs-toggle="tab" href="#project-subject" role="tab">
                                    Asignatura
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- end card body -->
                </div>
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="tab-content text-muted">
                <div class="tab-pane fade show active" id="project-overview" role="tabpanel">
                    <div class="row">
                        <div class="col-xl-9 col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    <div class="text-muted">
                                        <h6 class="mb-3 fw-semibold text-uppercase">Resumen</h6>
                                        <p><?= $model->descripcion ?></p>

                                        <ul class="ps-4 vstack gap-2 d-flex ">

                                            <li class="fs-15 mb-0">Plan de estudio : <?= $model->planEstudios->nombre; ?></li>
                                            <li class="fs-15 mb-0">Semestre : <?= $model->semestre->nombre; ?></li>
                                            <li class="fs-15 mb-0">Departamento : <?= $model->departamento->nombre; ?></li>
                                            <li class="fs-15 mb-0">Asesor Interno : <?= $model->asesorInterno->nombre; ?></li>
                                            <li class="fs-15 mb-0">Ingenieria : <?= $model->ingenieria->nombre; ?></li>
                                            <li class="fs-15 mb-0">Empresa : <?= $model->empresa->nombre; ?></li>
                                            <li class="fs-15 mb-0">Asesor Externo : <?= $model->asesorExterno->nombre; ?></li>
                                            <li class="fs-15 mb-0">Periodo : <?= $model->periodo->nombre; ?></li>
                                            <li class="fs-15 mb-0">Horas totales : <?= $model->horas_totales; ?></li>
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
                                                <div class="col-lg-3 col-sm-6">
                                                    <!--bloque de codigo que valida el estado del proyecto para cambiar dinamicamente los estilos del badge-->
                                                    <div>

                                                        <p class="mb-2 text-uppercase fw-medium">Estado :</p>
                                                        <?php
                                                        $badgeClass = 'bg-info'; // Clase predeterminada para el badge

                                                        // Verificar el valor de estadoProyecto->id y asignar la clase correspondiente al badge
                                                        if ($model->estadoProyecto->id == 1) {
                                                            $badgeClass = 'bg-info'; // Clase para el estado "Success"
                                                        } elseif ($model->estadoProyecto->id == 2) {
                                                            $badgeClass = 'bg-warning'; // Clase para el estado "Warning"
                                                        } elseif ($model->estadoProyecto->id == 3) {
                                                            $badgeClass = 'bg-success'; // Clase para el estado "Danger"
                                                        }
                                                        ?>

                                                        <div class="badge <?= $badgeClass ?> fs-12"><?= $model->estadoProyecto->nombre ?></div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- ene col -->
                        <div class="col-xl-3 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title mb-4">Asignaturas</h5>
                                    <div class="d-flex flex-wrap gap-2 fs-16">
                                        <!--Muestra las asignaturas que implica el proyecto-->
                                        <?php foreach ($dataProvider->models as $subject) { ?>
                                            <div class="badge fw-medium bg-secondary-subtle text-secondary">
                                                <?= Html::encode($subject->nombre) ?>
                                            </div>
                                        <?php } ?>

                                    </div>
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                </div>
                <!-- end tab pane -->
                <div class="tab-pane fade" id="project-subject" role="tabpanel">

                    <p>
                        <?= Html::a('Asignar/Quitar Asignatura', ['proyecto-asignatura/update', 'proyecto_id' => $model->id], ['class' => 'btn btn-success']) ?>
                    </p>

                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-4">
                                <h5 class="card-title flex-grow-1">Asignaturas</h5>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive table-card">

                                        <?= GridView::widget([

                                            'dataProvider' => $dataProvider,
                                            'tableOptions' => ['class' => 'table align-middle mb-0'],
                                            'headerRowOptions' => ['class' => 'table-light'],
                                            'columns' => [
                                                ['class' => 'yii\grid\SerialColumn'],

                                                //'id',
                                                'clave',
                                                'nombre',
                                                'creditos',
                                                'competencia_disciplinar:ntext',
                                                //'docente_id',
                                                'asesorInterno.nombre',
                                                'horas_dedicadas',
                                                'periodo_desarrollo',
                                                'periodo_acreditacion',
                                                //'semestre_id',


                                            ],
                                        ]); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end tab pane -->
            </div>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
</div>