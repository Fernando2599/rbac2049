<?php

use common\models\Proyecto;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;



/** @var yii\web\View $this */
/** @var backend\models\search\ProyectoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->registerJsFile(
    '@web/admin/functionAjax/ProjectAjax.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
)

?>
<div class="proyecto-index">

    <?php $this->title = 'Proyectos';
    $this->params['breadcrumbs'][] = $this->title; ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>
    <h4 class="mb-3"><?= Html::encode($this->title) ?></h4>

    <div class="card">

        <div class="card-header">
            <?=
            Html::a(Yii::t('app', 'Crear Proyecto'), ['create'], ['class' => 'btn btn-outline-secondary btn-border'])
            ?>
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
                        //'perfil_estudiante_id',
                        [
                            'label' => 'Matricula',
                            'attribute' => 'matriculaEstudiante',
                            'filter' => $searchModel->getMatriculasList()
                        ],
                        'nombre',
                        //'departamento_id',
                        [
                            'label' => 'Departamento',
                            'attribute' => 'departamentoNombre',
                            'filter' => $searchModel->getDepartamentoList()
                        ],
                        //'ingenieria_id',
                        [
                            'label' => 'Ingenieria',
                            'attribute' => 'ingenieriaNombre',
                            'filter' => $searchModel->getIngenieriasList()
                        ],
                        //'perfil_estudiante_id',
                        //'empresa_id',
                        //'asesor_externo_id',
                        //'estado_proyecto_id',
                        //'created_at',
                        //'updated_at',
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{view} {update} {delete}', // Incluye el botón de eliminar en la plantilla
                            'buttons' => [
                                'delete' => function ($url, $model, $key) {
                                    return '<a href="#" class="delete-project-button" data-bs-toggle="modal" data-bs-target="#removeProjectModal" data-project-id="' . $model->id . '"><i class="ri-delete-bin-fill align-bottom"></i></a>';
                                },
                            ],

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

    <!-- removeProjectModal -->
    <div id="removeProjectModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mt-2 text-center">
                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                            <h4>Esta seguro ?</h4>
                            <p class="text-muted mx-4 mb-0">Esta seguro de eliminar este projecto ?</p>
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Cerrar</button>
                        <a href="#" id="confirmDeleteButton" class="btn btn-danger">Eliminar</a>
                    </div>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->



</div>