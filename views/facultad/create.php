<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Facultad */

$this->title = 'Create Facultad';
$this->params['breadcrumbs'][] = ['label' => 'Facultads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="facultad-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
