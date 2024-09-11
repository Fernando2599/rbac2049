<?php

use common\models\ProyectoAsignatura;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var backend\models\search\ProyectoAsignaturaSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this -> registerCss("
.text-dark {
    color: white !important;
}

td.kv-group-even {
    background-color: #f0f1ff !important;
    
}


tr{
    font-size: 18px;
}
.btn-warning {
    color: white;
    background-color: #C0392B !important;
    border-color: #922B21;
}

.bg-info {
    background-color: #212F3C !important;
}

.border-info {
    border-color: black !important;
}

");

$this->title = 'Proyecto Asignaturas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proyecto-asignatura-index">

<?php Pjax::begin();?>


    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            ['class' => 'kartik\grid\SerialColumn'],
            //'id',
            //[
            //    'attribute' => 'proyecto_id',
            //    'value' => 'proyecto.nombre',
            //   'group' => true,
            //    'groupedRow' => true,
            //    'groupOddCssClass' => 'kv-grouped-row',
            //    'groupEvenCssClass' => 'kv-grouped-row',

            //],
            [
                'attribute' => 'proyectoNombre', 
                'label' =>  Yii::t('app', 'Proyecto'),
                'value' => 'proyecto.nombre' ,
                'group' => true, 
            ], 
            [
                'attribute' => 'asignaturaNombre', 
                'value' => 'asignatura.nombre' ,
                'label' =>  Yii::t('app', 'Asignatura'),
            ],

            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, ProyectoAsignatura $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id, 'proyecto_id' => $model->proyecto_id, 'asignatura_id' => $model->asignatura_id]);
                }
            ],

        ],

        'pjax' => true,
        'responsive' => true,
        'hover' => true,
        'toggleDataOptions' => [
            'maxCount' => true,
        ],
        'toolbar' => [
            '{export}',
            '{toggleData}'
        ],

        'panel' => [
            'heading' => $this->title,
            'type' => 'info',
            'before' => Html::a(Yii::t('app', 'Crear Proyecto-Asignatura'), ['create'], ['class' => 'btn btn-outline-success']),
            'after' => Html::a('<i class="fas fa-redo"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
            'footer' => false
        ],

    ]); ?>



</div>


