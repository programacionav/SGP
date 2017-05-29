<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Facultad */

$this->title = 'Update Facultad: ' . $model->idFacultad;
$this->params['breadcrumbs'][] = ['label' => 'Facultads', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idFacultad, 'url' => ['view', 'id' => $model->idFacultad]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="facultad-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
