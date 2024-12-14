<?php

use common\models\GradoAcademico;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\LinkPager;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->registerJsFile(
    '@web/theme/functionAjax/gradoAcademicoAjax.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);

?>
<div class="grado-academico-index">

    <?php $this->title = 'Grado Academicos';
    $this->params['breadcrumbs'][] = $this->title; ?>

    <h4 class="mb-3"><?= Html::encode($this->title) ?></h4>

    <div class="card">

        <div class="card-header">
            <?= Html::a('Crear Grado Academico', ['create'], ['class' => 'btn btn-outline-secondary btn-border']) ?>
        </div>

        <div class="card-body">

            <div class="table-responsive">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'tableOptions' => ['class' => 'table align-middle mb-0'],
                    'headerRowOptions' => ['class' => 'table-light'],
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        //'id',
                        'nombre',
                        [
                            'attribute' => 'estado',
                            'format' => 'raw', // Permite HTML para personalizar el contenido
                            'value' => function ($model) {
                                if ($model->estado == 1) {
                                    $badgeClass = 'bg-success'; // Clase CSS para el badge "Activo"
                                    $badgeText = 'Activo';
                                } elseif ($model->estado == 2) {
                                    $badgeClass = 'bg-danger'; // Clase CSS para el badge "Inactivo"
                                    $badgeText = 'Inactivo';
                                }

                                return '<span class="badge ' . $badgeClass . '">' . $badgeText . '</span>';
                            },
                        ],

                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{switch}',
                            'buttons' => [
                                //Switch para cambiar el estado de la asignatura si esta habilita o deshabilitada
                                'switch' => function ($url, $model, $key) {
                                    return '
                                        <div class="form-check form-switch form-switch-secondary">
                                            <input 
                                            class="form-check-input switch-estado" 
                                            type="checkbox" 
                                            role="switch" 
                                            data-grado-id="' . $model->id . '" 
                                            ' . ($model->estado == 1 ? 'checked' : '') . '>
                                            <label class="form-check-label">Estado</label>
                                        </div>';
                                },
                            ],
                        ],

                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{view} {update} {delete}', // Incluye el botón de eliminar en la plantilla
                            'buttons' => [
                                'delete' => function ($url, $model, $key) {
                                    return '<a href="#" class="delete-academico-button" data-bs-toggle="modal" data-bs-target="#removeAcademicoModal" data-academico-id="' . $model->id . '"><i class="ri-delete-bin-fill align-bottom"></i></a>';
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
    <div id="removeAcademicoModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
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
                            <p class="text-muted mx-4 mb-0">Esta seguro de eliminar este registro ?</p>
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