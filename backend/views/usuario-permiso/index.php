<?php

use backend\models\UsuarioPermiso;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\search\UsuarioPermisoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Usuarios Con Permisos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuario-permiso-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Asignar Permiso a Usuario', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            //'user_id',
            'userName',
            //'permiso_id',
            'permisoNombre',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
