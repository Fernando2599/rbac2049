<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\ProyectoDocente $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Proyecto Docentes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="proyecto-docente-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id, 'proyecto_id' => $model->proyecto_id, 'docente_id' => $model->docente_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id, 'proyecto_id' => $model->proyecto_id, 'docente_id' => $model->docente_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            //'proyecto_id',
            [ 'label' => 'Proyecto', 'value' => function ($searchModel) 
            { 
                return $searchModel->proyecto->nombre; 
            } ],
            //'docente_id',
            [ 'label' => 'Docente', 'value' => function ($searchModel) 
            { 
                return $searchModel->docente->nombre; 
            } ],
        ],
    ]) ?>

</div>
