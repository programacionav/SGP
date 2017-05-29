<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Observacion */

$this->title = 'Create Observacion';
$this->params['breadcrumbs'][] = ['label' => 'Observacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="observacion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('Observacion/_form', [
        'modelOb' => $model,
    ]) ?>

</div>
