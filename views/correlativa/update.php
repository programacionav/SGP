<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Correlativa */

$this->title = 'Update Correlativa: ' . $model->idMateria1;
$this->params['breadcrumbs'][] = ['label' => 'Correlativas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idMateria1, 'url' => ['view', 'idMateria1' => $model->idMateria1, 'idMateria2' => $model->idMateria2]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="correlativa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
