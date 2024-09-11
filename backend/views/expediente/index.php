<?php

use common\models\Expediente;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\LinkPager;

/** @var yii\web\View $this */
/** @var backend\models\search\ExpedienteSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Expedientes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expediente-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <h4 class="mb-3"><?= Html::encode($this->title) ?></h4>

    <div class="card">

        <div class="card-body">

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'tableOptions' => ['class' => 'table align-middle mb-0'],
                'headerRowOptions' => ['class' => 'table-light'],
                'columns' => [

                    ['class' => 'yii\grid\SerialColumn'],
                    'id',
                    'perfil_estudiante_id',
                    'created_at',
                    'updated_at',
                    'fecha_cierre',

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view} {update} {delete}', // Incluye el botón de eliminar en la plantilla
                        'buttons' => [
                            'delete' => function ($url, $model, $key) {
                                return '<a href="#" class="delete-project-button" data-bs-toggle="modal" data-bs-target="#removeProjectModal" data-project-id="' . $model->id . '"><i class="ri-delete-bin-fill align-bottom"></i></a>';
                            },
                        ],

                    ],

                ],

                'pager' => [
                    'class' => LinkPager::class,
                    'options' => ['class' => 'pagination justify-content-end pt-2'],
                    'linkContainerOptions' => ['class' => 'page-item'],
                    'linkOptions' => ['class' => 'page-link'],
                ],

            ]); ?>

        </div>

    </div>

</div>