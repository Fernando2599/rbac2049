<?php

use common\models\DocumentoExpediente;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var frontend\models\search\DocumentoExpedienteSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Documento Expedientes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documento-expediente-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Documento Expediente', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'documento_id',
            //'expediente_id',
            'ruta',
            'created_at',
            'updated_at',
            //'comentario:ntext',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, DocumentoExpediente $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'documento_id' => $model->documento_id, 'expediente_id' => $model->expediente_id]);
                }
            ],
        ],
    ]); ?>


</div>
