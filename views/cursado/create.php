<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Cursado */

$this->title = 'Create Cursado';
$this->params['breadcrumbs'][] = ['label' => 'Cursados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cursado-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
