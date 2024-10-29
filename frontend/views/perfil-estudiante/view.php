<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\PermisosHelpers;
use common\models\Genero;

/** @var yii\web\View $this */
/** @var common\models\PerfilEstudiante $model */

$this->title = 'Perfil: ' . $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Perfil Estudiantes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="perfil-estudiante-view">

<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?Php

        //esto no es necesario pero está aquí como ejemplo

        if (PermisosHelpers::userDebeSerPropietario('perfil_estudiante', $model->id)) {

            echo Html::a('Actualizar', ['update', 'id' => $model->id],
                ['class' => 'btn btn-primary']);
        } ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            //'user_id',
            'nombre',
            'matricula',
            'ingenieria.nombre',
            'especialidad.nombre',
            //'genero_id',
            'genero.nombre',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
