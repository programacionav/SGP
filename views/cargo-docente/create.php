<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CargoDocente */

$this->title = 'Create Cargo Docente';
$this->params['breadcrumbs'][] = ['label' => 'Cargo Docentes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cargo-docente-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
