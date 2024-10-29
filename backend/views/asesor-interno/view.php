<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\AsesorInterno $model */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Asesor Internos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="asesor-interno-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>
    <div class="col-xxl-12">

        <div class="card">

            <div class="card-body">
                <h6 class="mb-3 fs-15 fw-semibold text-uppercase">Detalles</h6>

                <div class="row">
                    <div class="col-md-6">
                        <ul class="ps-4 vstack gap-2 d-flex ">
                            <li class="fs-15 mb-0 fw-semibold"> Nombre: <span class="fw-normal"> <?= $model->nombre ?> </span> </li>
                            <li class="fs-15 mb-0 fw-semibold">Ingenieria: <span class="fw-normal"> <?= $model->ingenieria->nombre ?> </span> </li>

                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="ps-4 vstack gap-2 d-flex ">
                            <li class="fs-15 mb-0 fw-semibold">Grado Academico: <span class="fw-normal"> <?= $model->gradoAcademico->nombre ?> </span> </li>
                            <li class="fs-15 mb-0 fw-semibold">Genero: <span class="fw-normal"> <?= $model->genero->nombre ?> </span> </li>
                        </ul>
                    </div>

                </div>
            </div>

        </div>

    </div>


</div>