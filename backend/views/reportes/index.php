<?php

/** @var yii\web\View $this */
?>
<h4 class="mb-3">Reportes</h4>

<div class="card">
    <div class="card-header">
        <p class="text-uppercase fw-medium text-muted m-0">Metricas de nivel de desempeño</p>
    </div>
    <div class="card-body">
        <div class="d-flex flex-wrap justify-content-between">
            <a class="btn btn-ghost-primary btn-animation waves-effect waves-light"href="<?= \yii\helpers\Url::to(['reportes/estudiantes-report']) ?>" 
            target="_blank">
                <i class="ri-article-line" style="font-size: 24px;"></i>
                <p class="fw-medium" style="white-space: pre-line;">Estudiantes en educación dual</p>
            </a>
            <a class="btn btn-ghost-primary btn-animation waves-effect waves-light">
                <i class="ri-article-line" style="font-size: 24px;"></i>
                <p class="fw-medium" style="white-space: pre-line;">Estudiantes en Abandono</p>
            </a>
            <a class="btn btn-ghost-primary btn-animation waves-effect waves-light">
                <i class="ri-article-line" style="font-size: 24px;"></i>
                <p class="fw-medium" style="white-space: pre-line;">Docentes en educación dual</p>
            </a>
            <a class="btn btn-ghost-primary btn-animation waves-effect waves-light">
                <i class="ri-article-line" style="font-size: 24px;"></i>
                <p class="fw-medium" style="white-space: pre-line;">Docentes con capacitacion</p>
            </a>
            <a class="btn btn-ghost-primary btn-animation waves-effect waves-light">
                <i class="ri-article-line" style="font-size: 24px;"></i>
                <p class="fw-medium" style="white-space: pre-line;">Estudiantes titulados</p>
            </a>
        </div>
    </div>
</div>