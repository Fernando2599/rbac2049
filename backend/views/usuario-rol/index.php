<?php

use backend\models\UsuarioRol;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\search\UsuarioRolSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Usuarios Roles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuario-rol-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Asignar Rol a Usuario', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            //'user_id',
            //'rol_id',
            'userName',
            'rolNombre',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, UsuarioRol $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id, 'user_id' => $model->user_id, 'rol_id' => $model->rol_id]);
                 }
            ],
        ],
    ]); ?>


</div>
