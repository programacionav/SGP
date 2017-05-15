<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Dedicacion */

$this->title = 'Create Dedicacion';
$this->params['breadcrumbs'][] = ['label' => 'Dedicacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dedicacion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
