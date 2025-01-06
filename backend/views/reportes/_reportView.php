<?php

/** @var yii\web\View $this */
/** @var app\models\Estudiante[] $estudiantes */
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/theme/css/bootstrap.min.css">
    <link rel="stylesheet" href="/theme/css/app.min.css">
    <link rel="stylesheet" href="/theme/css/icons.min.css">
    <link rel="stylesheet" href="/theme/css/custom.min.css">
</head>

<body>
    <div class="table-responsive">

        <!-- Table Head -->
        <table class="table align-middle table-nowrap mb-0 table-bordered">
            <thead class="table-light">
                <tr>
                    <th scope="col">Nombre</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($estudiantes as $estudiante): ?>
                    <tr>
                        <td><?= htmlspecialchars($estudiante->nombre) ?></td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>
</body>

</html>