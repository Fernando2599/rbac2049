<?php

use common\models\Documento;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var frontend\models\search\DocumentoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Documentos pendientes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documento-index" style="padding: 70px 45px 50px;">

    <h1 class="text-center m-3"><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <div class="m-3">
        <?php
        echo '<a href="' . \yii\helpers\Url::to(['/site/index']) . '" class="btn btn-ghost-dark waves-effect waves-light">'
            . '<i class="ri-arrow-left-line"></i> Regresar'
            . '</a>';
        ?>
    </div>

    <div class="card">

        <div class="card-body">

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'id',
                    'nombre',
                    //'descripcion:ntext',
                    'fecha_inicio:date',
                    'fecha_cierre:date',
                    //'estado_documento_id',
                    //'created_at',
                    //'updated_at',
                    [
                        'class' => ActionColumn::className(),
                        'template' => '{view}',
                        'urlCreator' => function ($action, Documento $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'id' => $model->id]);
                        }
                    ],
                ],
            ]); ?>

        </div>

    </div>




</div>