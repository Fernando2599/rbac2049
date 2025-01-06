<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Ajuste $model */
$this->registerJsFile(
    '@web/theme/functionAjax/ajusteMembrete.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);

$this->title = 'Ajustes';
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="ajuste-view">

    <h2 class="mb-3"><?= Html::encode($this->title) ?></h2>

    <div class="card">
        <div class="card-header">
            <p class="text-uppercase fw-medium text-muted m-0">Ajustes generales del sistema</p>
        </div>
        <div class="card-body">
            <p>
                <?= Html::a('Actualizar información', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    //'id',
                    'email_admin',
                    'num_semanas_semestre',
                    'inicio_preregistro:date',
                    'fin_preregistro:date',
                ],
            ]) ?>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <p class="text-uppercase fw-medium text-muted m-0">Ajustes Encabezado y pie de pagina para los reportes en PDF</p>
        </div>
        <div class="card-body">
            <div class="profile-user w-100 h-50 mb-3">
                <div>
                    <input id="membrete-header-file-input" type="file" name="Membrete[archivo]" class="d-none" accept="image/*">
                    <label for="membrete-header-file-input" class="d-block" tabindex="0">
                        <span class="overflow-hidden border border-dashed d-flex align-items-center justify-content-center rounded" style="height: auto; width: auto;">
                            <img id="membrete-preview-header" src="<?= $rutaHeader ?>" class="user-profile-image img-fluid" alt="SIN IMAGEN">
                        </span>
                    </label>
                </div>

                <div id="upload-status" class="mt-3"></div>
            </div>
            <div class="profile-user w-100 h-50 mb-3">
                <div>
                    <input id="membrete-footer-file-input" type="file" name="Membrete[archivo]" class="d-none" accept="image/*">
                    <label for="membrete-footer-file-input" class="d-block" tabindex="0">
                        <span class="overflow-hidden border border-dashed d-flex align-items-center justify-content-center rounded" style="height: auto; width: auto;">
                            <img id="membrete-preview-footer" src="<?= $rutaFooter ?>" class="user-profile-image img-fluid" alt="SIN IMAGEN">
                        </span>
                    </label>
                </div>

                <div id="upload-status" class="mt-3"></div>
            </div>
        </div>
    </div>
</div>

<script>

</script>