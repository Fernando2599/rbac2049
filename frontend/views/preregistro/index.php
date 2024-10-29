<?php

use common\models\Preregistro;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var frontend\models\search\PreregistroSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Preregistros';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="preregistro-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Preregistro', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nombre',
            'matricula',
            'email:email',
            'ingenieria_id',
            //'kardex',
            //'constancia_ingles',
            //'constancia_servicio_social',
            //'constancia_creditos_complementarios',
            //'created_at',
            //'updated_at',
            //'estado_registro_id',
            //'comentario:ntext',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Preregistro $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>
