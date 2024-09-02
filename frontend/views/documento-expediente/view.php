<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\DocumentoExpediente $model */

$this->title = 'Detalles del documento';
$this->params['breadcrumbs'][] = ['label' => 'Documento Expedientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="documento-expediente-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modificar archivo', ['update', 'documento_id' => $model->documento_id, 'expediente_id' => $model->expediente_id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [ 'label' => 'Documento', 'value' => function ($searchModel) 
            { 
                return $searchModel->documento->nombre; 
            } ],
            //'expediente_id',
            [
                'attribute' => 'ruta',
                'format' => 'html',
                'value' => function($model)
                {
                    return Html::a(basename($model->ruta), ['download', 'filename' => $model -> ruta]);
                }
            ],
            'created_at:datetime',
            'updated_at:datetime',
            'comentario:ntext',
        ],
    ]) ?>

</div>
