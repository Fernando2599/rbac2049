<?php

use common\models\Ingenieria;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\LinkPager;


/** @var yii\web\View $this */
/** @var backend\models\search\IngenieriaSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Ingenierias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ingenieria-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <div class="card">

        <div class="card-header">

            <?=
            Html::a(Yii::t('app', 'Crear especialidad'), ['create'], ['class' => 'btn btn-outline-secondary btn-border'])
            ?>
            
        </div>

        <div class="card-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'tableOptions' => ['class' => 'table align-middle mb-0'],
                'headerRowOptions' => ['class' => 'table-light'],
                'columns' => [

                    ['class' => 'yii\grid\SerialColumn'],
                    //'id',
                    'nombre',

                    [
                        'class' => ActionColumn::className(),
                        'template' => '{view} {update}',
                        'urlCreator' => function ($action, Ingenieria $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'id' => $model->id]);
                        }
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