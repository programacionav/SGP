<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Plan */

$this->title = 'Nuevo Plan';
//$this->params['breadcrumbs'][] = ['label' => 'Plan', 'url' => ['index']]; crear vista parcial o mandar a carreras?
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
