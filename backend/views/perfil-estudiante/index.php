<?php

use common\models\PerfilEstudiante;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\LinkPager;

/** @var yii\web\View $this */
/** @var backend\models\search\PerfilEstudianteSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Estudiantes Duales';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="perfil-estudiante-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>
    <h4><?= Html::encode($this->title) ?></h4>

    <div class="card">
        <div class="card-header">

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'tableOptions' => ['class' => 'table align-middle mb-0'],
                    'headerRowOptions' => ['class' => 'table-light'],
                    'columns' => [

                        ['class' => 'yii\grid\SerialColumn'],
                        //'id',
                        //'user_id',
                        'nombre',
                        'matricula',
                        ['label' => 'Ingenieria', 'attribute' => 'ingenieriaNombre', 'filter' => $searchModel->getIngenieriasList()],
                        ['attribute' => 'expedienteLink', 'format' => 'raw'],
                        ['attribute' => 'estadoExpedienteLink', 'format' => 'raw'],
                        //'genero_id',
                        //'especialidad_id',
                        //'created_at',
                        //'updated_at',
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{view}', // Incluye el botón de eliminar en la plantilla
                            

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