<?php

use common\models\Departamento;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\LinkPager;


/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Departamentos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="departamento-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="card">

        <div class="card-header">
            <?= Html::a('Crear Departamento', ['create'], ['class' => 'btn btn-outline-secondary btn-border']) ?>
        </div>

        <div class="card-body">

            <div class="table-responsive">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'tableOptions' => ['class' => 'table align-middle mb-0'],
                    'headerRowOptions' => ['class' => 'table-light'],
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        'id',
                        'nombre',
                        [
                            'class' => ActionColumn::className(),
                            'urlCreator' => function ($action, Departamento $model, $key, $index, $column) {
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

</div>