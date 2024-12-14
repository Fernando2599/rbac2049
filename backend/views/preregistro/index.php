<?php

use common\models\Preregistro;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\LinkPager;

/** @var yii\web\View $this */
/** @var backend\models\search\PreregistroSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */



$this->title = 'Preregistros';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="preregistro-index">




    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>
    <div class="card">

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
                        'nombre',
                        'matricula',
                        'email:email',
                        //'ingenieria_id',
                        ['label' => 'Ingenieria', 'attribute' => 'ingenieriaNombre', 'filter' => $searchModel->getIngenieriasList()],
                        //'kardex',
                        //'constancia_ingles',
                        //'constancia_servicio_social',
                        //'constancia_creditos_complementarios',
                        //'created_at',
                        //'updated_at',
                        //'estado_registro_id',
                        
                        [
                            'label' => 'Estado',
                            'format' => 'raw', // Permite HTML para personalizar el contenido
                            'filter' => $searchModel->getEstadoRegistroNombreList(),
                            'value' => function ($model) {
                                $badgeClass = 'bg-info'; // Clase predeterminada para el badge
                                if ($model->estado_registro_id == 1) {
                                    $badgeClass = 'bg-info'; 
                                } elseif ($model->estado_registro_id == 2) {
                                    $badgeClass = 'bg-warning'; 
                                } elseif ($model->estado_registro_id == 3) {
                                    $badgeClass = 'bg-danger'; 
                                } elseif ($model->estado_registro_id == 4) {
                                    $badgeClass = 'bg-success'; 
                                }

                                return '<span class="badge ' . $badgeClass . '">' . $model->estadoRegistro->nombre    . '</span>';
                            },
                        ],
                        //'comentario:ntext',


                        [
                            'class' => ActionColumn::className(),
                            'template' => '{view}',
                            'urlCreator' => function ($action, Preregistro $model, $key, $index, $column) {
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