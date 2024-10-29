<?php

use common\models\Documento;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;

/** @var yii\web\View $this */
/** @var backend\models\search\DocumentoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Documentos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documento-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>
    <div class="card">

        <div class="card-header">
            <?=
            Html::a(Yii::t('app', 'Crear Documento'), ['create'], ['class' => 'btn btn-outline-secondary btn-border'])
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
                    'fecha_inicio:date',
                    'fecha_cierre:date',
                    //'created_at',
                    //'updated_at',,

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view} {update}', // Incluye el botón de eliminar en la plantilla


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