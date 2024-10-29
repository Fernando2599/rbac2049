<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\PerfilEstudiante $model */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Estudiantes Duales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="perfil-estudiante-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="col-xxl-12">

        <div class="card">

            <div class="card-body">

                <h6 class="mb-3 fs-15 fw-semibold text-uppercase">Detalles</h6>

                <div class="row">

                    <div class="col-md-12">

                        <ul class="ps-4 vstack gap-2 d-flex ">

                            <li class="fs-15 mb-0 fw-semibold"> Nombre: <span class="fw-normal"> <?= $model->nombre ?> </span> </li>
                            <li class="fs-15 mb-0 fw-semibold"> Matricula: <span class="fw-normal"> <?= $model->matricula ?> </span> </li>
                            <li class="fs-15 mb-0 fw-semibold"> Ingenieria: <span class="fw-normal"> <?= $model->ingenieria->nombre ?> </span> </li>
                            <li class="fs-15 mb-0 fw-semibold"> Correo: <span class="fw-normal"> <?= $model->user->email ?> </span> </li>
                            <li class="fs-15 mb-0 fw-semibold"> Genero: <span class="fw-normal"> <?= !empty($model->genero->nombre) ? $model->genero->nombre : 'No hay dato' ?> </span> </li>
                            <li class="fs-15 mb-0 fw-semibold"> Especialidad: <span class="fw-normal"> <?= !empty($model->especialidad->nombre) ? $model->especialidad->nombre : 'No hay dato' ?> </span> </li>

                        </ul>

                    </div>

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

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>