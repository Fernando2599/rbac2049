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
<div class="expediente-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            [ 'label' => 'Estudiante', 'value' => function ($searchModel) 
            { 
                return $searchModel->perfilEstudiante->nombre; 
            } ],
            'created_at:datetime',
            //'updated_at:datetime',
            //'fecha_cierre',
            [ 'label' => 'Estado', 'value' => function ($searchModel) 
            { 
                return $searchModel->estadoExpediente->nombre; 
            } ],
        ],
    ]) ?>

    <h2>Documentos Entregados</h2>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'documento_id',
            [ 'label' => 'Documento', 'value' => function ($searchModel) 
            { 
                return $searchModel->documento->nombre; 
            } ],
            //'expediente_id',
            [
                'attribute' => 'ruta',
                'format' => 'html',
                'value' => function($model)
                {
                    return Html::a(basename($model->ruta), ['file', 'filename' => $model -> ruta]);
                }
            ],
            'created_at:datetime',
            'updated_at:datetime',
            //'comentario:ntext',
            ['class' => 'yii\grid\ActionColumn', 'controller' => 'documento-expediente', 'template'=>'{view},{update}'],
        ],
    ]); ?>

</div>