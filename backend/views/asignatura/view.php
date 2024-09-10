<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Asignatura $model */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Asignaturas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="asignatura-view">

    <h4><?= Html::encode($this->title) ?></h4>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <div class="col-xxl-12">
        <div class="card">
            <div class="card-body">
                <div class="">
                    <h6 class="mb-3 fs-15 fw-semibold text-uppercase">Detalles</h6>
                    <p class="fs-15 fw-semibold text-muted">Competencias disciplinarias</p>
                    <ul>
                        <?php
                        // Divide el texto en párrafos usando la función explode()
                        $paragraphs = explode("\n", $model->competencia_disciplinar);

                        // Itera sobre cada párrafo y muestra cada uno como un elemento de lista
                        foreach ($paragraphs as $paragraph) {
                            // Verifica si el párrafo no está vacío antes de mostrarlo
                            if (!empty(trim($paragraph))) {
                                echo "<li class='fs-15 mb-3'>$paragraph</li>";
                            }
                        }
                        ?>
                    </ul>

                    <div class="row">
                        <div class="col-md-6">
                            <ul class="ps-4 vstack gap-2 d-flex ">
                                <li class="fs-15 mb-0 fw-semibold">Nombre: <span class="fw-normal"> <?= $model->nombre ?> </span></li>
                                <li class="fs-15 mb-0 fw-semibold">Docente: <span class="fw-normal"> <?= $model->asesorInterno->nombre ?> </span></li>
                                <li class="fs-15 mb-0 fw-semibold">Ingenieria: <span class="fw-normal"> <?= $model->ingenieria->nombre ?> </span></li>
                                <li class="fs-15 mb-0 fw-semibold">Especialidad: <span class="fw-normal"> <?= $model->especialidad->nombre ?> </span></li>
                                <li class="fs-15 mb-0 fw-semibold">Semanas: <span class="fw-normal"> <?= $model->semanas ?> </span></li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="ps-4 vstack gap-2 d-flex ">
                                <li class="fs-15 mb-0 fw-semibold">Clave: <span class="fw-normal"> <?= $model->clave ?> </span></li>
                                <li class="fs-15 mb-0 fw-semibold">Creditos: <span class="fw-normal"> <?= $model->creditos ?> </span></li>
                                <li class="fs-15 mb-0 fw-semibold">Semestre: <span class="fw-normal"> <?= $model->semestre->nombre ?> </span></li>
                                <li class="fs-15 mb-0 fw-semibold">Horas: <span class="fw-normal"> <?= $model->horas_dedicadas ?> </span></li>
                                <li class="fs-15 mb-0 fw-semibold">Total de creditos por semana: <span class="fw-normal"> <?= $model->creditos * $model->semanas ?> </span></li>
                            </ul>
                        </div>
                    </div>


                    <h6 class="mb-3 fs-15 fw-semibold text-uppercase">Periodo de Desarrollo</h6>

                    <div class="row">

                        <div class="col-lg-3 col-sm-6">
                            <div>
                                <p class="mb-2 text-uppercase fw-medium">Fecha de inicio :</p>
                                <h5 class="fs-15 mb-0"><?= $model->periodo_desarrollo ?></h5>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div>
                                <p class="mb-2 text-uppercase fw-medium">Fecha de terminación : </p>
                                <h5 class="fs-15 mb-0"><?= $model->periodo_acreditacion ?></h5>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!--end card-->
    </div>
    <!--end col-->

</div>