<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\Ingenieria $model */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Ingenierias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="ingenieria-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Ver especialidades', ['especialidad/index'], ['class' => 'btn btn-primary']) ?>
    </p>


    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <div class="card">

        <div class="card-header">
            <h5 class="m-1"> Asignaturas de <?= $this->title ?> </h5>
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
                    'clave',
                    'creditos',
                    'competencia_disciplinar:ntext',
                    //'docente_id',
                    ['label' => 'Docente', 'attribute' => 'asesorInternoNombre', 'filter' => $searchModel->getAsesorInternoList()],
                    //'horas_dedicadas',
                    //'periodo_desarrollo',
                    //'periodo_acreditacion',
                    //'semestre_id',

                    [
                        'class' => 'yii\grid\ActionColumn', 'controller' => 'asignatura',
                        'template' => '{view} {update} {switch}',
                        'buttons' => [
                            //Switch para cambiar el estado de la asignatura si esta habilita o deshabilitada
                            'switch' => function ($url, $model, $key) {
                                return '
                                        <div class="form-check form-switch form-switch-secondary">
                                            <input 
                                            class="form-check-input" 
                                            type="checkbox" role="switch" 
                                            id="SwitchEstado' . $model->id . '" 
                                            checked>
                                            <label class="form-check-label" for="SwitchEstadoLabel">Estado</label>
                                        </div>';
                            },
                        ],
                    ],

                ],

            ]); ?>

        </div>

    </div>



</div>