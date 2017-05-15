<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Departamentodocente */

$this->title = 'Create Departamentodocente';
$this->params['breadcrumbs'][] = ['label' => 'Departamentodocentes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="departamentodocente-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
