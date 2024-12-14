<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\GradoAcademico $model */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Grado Academicos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="grado-academico-view">

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

                        </ul>

                    </div>

                    <div class="col-md-6">

                        <ul class="ps-4 vstack gap-2 d-flex ">

                            <!--bloque de codigo que valida el estado del registro para cambiar dinamicamente los estilos del badge-->
                            <div>
                                
                                <?php
                                $badgeClass = 'bg-success'; // Clase predeterminada para el badge
                                $badgeText = 'Activo'; // Clase predeterminada para el texto del badge

                                // Verificar el valor de estadoProyecto->id y asignar la clase correspondiente al badge
                                if ($model->estado == 1) {
                                    $badgeClass = 'bg-success'; // Clase para el estado "Success"
                                    $badgeText = 'Activo'; // Clase predeterminada para el texto del badge
                                } elseif ($model->estado == 2) {
                                    $badgeClass = 'bg-danger'; // Clase para el estado "Warning"
                                    $badgeText = 'Inactivo'; // Clase predeterminada para el texto del badge
                                }
                                ?>

                                <li class="fs-15 mb-0 fw-semibold"> Estado: <span class="fs-12 badge <?= $badgeClass ?>"> <?= $badgeText ?> </span> </li>

                            </div>

                        </ul>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>