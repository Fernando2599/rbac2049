<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\RegistrosHelpers;

/** @var yii\web\View $this */
/** @var common\models\Documento $model */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Documentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

date_default_timezone_set("America/Mexico_City");

$fecha_actual= date('Y-m-d');
$fecha_inicio = date($model->fecha_inicio);
$fecha_cierre = date($model->fecha_cierre);
?>
<div class="documento-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php

    if (RegistrosHelpers::validarFecha($fecha_inicio, $fecha_cierre, $fecha_actual)) { ?>
    <p>
    <?= Html::a('Subir documento', ['documento-expediente/create', 'documento_id' => $model->id], ['class' => 'btn btn-success']) ?>
    </p>
<?php }
else {
    echo '<div class="alert alert-danger" style="color: white;">No es posible subir el documento, verifique la fecha de disponibilidad.</div>';
}

?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'nombre',
            'descripcion:ntext',
            'fecha_inicio:date',
            'fecha_cierre:date',
            //'created_at',
            //'updated_at',
        ],
    ]) ?>

</div>
