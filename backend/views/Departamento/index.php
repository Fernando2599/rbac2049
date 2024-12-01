<?php

use common\models\Departamento;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\LinkPager;


/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->registerJsFile(
    '@web/theme/functionAjax/departamentoAjax.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
)

?>
<div class="departamento-index">

    <?php $this->title = 'Departamento';
    $this->params['breadcrumbs'][] = $this->title; ?>

    <h4 class="mb-3"><?= Html::encode($this->title) ?></h4>

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
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{view} {update} {delete}', // Incluye el botón de eliminar en la plantilla
                            'buttons' => [
                                'delete' => function ($url, $model, $key) {
                                    return '<a href="#" class="delete-departamento-button" data-bs-toggle="modal" data-bs-target="#removeDepartamentoModal" data-departamento-id="' . $model->id . '"><i class="ri-delete-bin-fill align-bottom"></i></a>';
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
    <div id="removeDepartamentoModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
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