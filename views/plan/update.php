<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Plan */

$this->title = 'Modificar Plan ' ;
//$this->params['breadcrumbs'][] = ['label' => 'Plan', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->idPlan, 'url' => ['view', 'id' => $model->idPlan]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="plan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
