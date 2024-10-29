<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var common\models\Expediente $model */

$this->title = 'Expediente';
$this->params['breadcrumbs'][] = ['label' => 'Expedientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="expediente-view" style="padding: 70px 45px 50px;">

    <h1 class="text-center m-3"><?= Html::encode($this->title) ?></h1>

    <div class="m-3">
        <?php
        echo '<a href="' . \yii\helpers\Url::to(['/site/index']) . '" class="btn btn-ghost-dark waves-effect waves-light">'
            . '<i class="ri-arrow-left-line"></i> Regresar'
            . '</a>';
        ?>
    </div>

    <div class="card">

        <div class="card-body">

            <h6 class="mb-3 fs-15 fw-semibold text-uppercase">Detalles</h6>

            <div class="row">

                <div class="col-md-8">

                    <div class="d-flex justify-content-between align-items-center">

                        <p class="fs-15 mb-0 fw-semibold"> Nombre: <span class="fw-normal"> <?= $model->perfilEstudiante->nombre ?> </span> </p>
                        <p class="fs-15 mb-0 fw-semibold"> Fechad de creación: <span class="fw-normal"> <?= $model->created_at ?> </span> </p>
                        <p class="fs-15 mb-0 fw-semibold"> Estado: 
                            
                                <?php
                                $badgeClass = 'bg-info'; // Clase predeterminada para el badge

                                // Verificar el valor de estadoExpediente->id y asignar la clase correspondiente al badge
                                if ($model->estadoExpediente->id == 1) {
                                    $badgeClass = 'bg-info'; // Clase para el estado "Success"
                                } elseif ($model->estadoExpediente->id == 2) {
                                    $badgeClass = 'bg-danger'; // Clase para el estado "Warning"
                                } elseif ($model->estadoExpediente->id == 3) {
                                    $badgeClass = 'bg-success'; // Clase para el estado "Danger"
                                }
                                ?>

                                <span class="badge <?= $badgeClass ?> fs-12"><?= $model->estadoExpediente->nombre ?></span>
                            
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="card">

        <div class="card-header">

            <h2>Documentos Entregados</h2>

        </div>

        <div class="card-body">

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'tableOptions' => ['class' => 'table align-middle mb-0'],
                'headerRowOptions' => ['class' => 'table-light'],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'documento_id',
                    ['label' => 'Documento', 'value' => function ($searchModel) {
                        return $searchModel->documento->nombre;
                    }],
                    //'expediente_id',
                    [
                        'attribute' => 'ruta',
                        'format' => 'html',
                        'value' => function ($model) {
                            return Html::a(basename($model->ruta), ['download', 'filename' => $model->ruta]);
                            
                        }
                    ],
                    'created_at:datetime',
                    'updated_at:datetime',
                    //'comentario:ntext',
                    ['class' => 'yii\grid\ActionColumn', 'controller' => 'documento-expediente', 'template' => '{view},{update}'],
                ],
            ]); ?>

        </div>

    </div>



</div>