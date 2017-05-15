<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Designado */

$this->title = 'Create Designado';
$this->params['breadcrumbs'][] = ['label' => 'Designados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="designado-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
