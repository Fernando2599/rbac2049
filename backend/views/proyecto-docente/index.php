<?php

use common\models\ProyectoDocente;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\grid\ActionColumn;


/** @var yii\web\View $this */
/** @var backend\models\search\ProyectoDocenteSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this -> registerCss("
.text-dark {
    color: white !important;
}



td.kv-group-even {
    background-color: #f0f1ff !important;
    font-size: 20px;
    text-align: justify;
    font-weight: bold; 
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
$this->title = 'Proyecto Docentes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proyecto-docente-index">

 
<?php Pjax::begin();?>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
        <?= GridView::widget([
        'dataProvider'=> $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            
            ['class' => 'kartik\grid\SerialColumn'],
            //'id',
            [
                'attribute' => 'proyectoNombre', 
                'label' =>  Yii::t('app', 'Proyecto'),
                'value' => 'proyecto.nombre' ,
                'group' => true, 
            ], 
            [
                'attribute' => 'docenteNombre', 
                'value' => 'docente.nombre' ,
                'label' =>  Yii::t('app', 'Docente'),
            ],

            ['class' => ActionColumn::className(),
            'urlCreator' => function ($action, ProyectoDocente $model, $key, $index, $column) {
                return Url::toRoute([$action, 'id' => $model->id, 'proyecto_id' => $model->proyecto_id, 'docente_id' => $model->docente_id]);
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
            'heading'=>$this->title,
            'type'=>'info',
            'before'=>Html::a(Yii::t('app', 'Crear ProyectoDocente'), ['create'], ['class' => 'btn btn-outline-success']),
            'after'=>Html::a('<i class="fas fa-redo"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
            'footer'=>false
        ],

        ]); ?>


</div>
