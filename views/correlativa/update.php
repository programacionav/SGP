<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Correlativa */

$this->title = 'Modificar Correlativa ' ;
$this->params['breadcrumbs'][] = ['label' => 'Correlativas', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->idMateria1, 'url' => ['view', 'idMateria1' => $model->idMateria1, 'idMateria2' => $model->idMateria2]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="correlativa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form1', [
        'unPlan'=>$unPlan,'model'=>$model
    ]) ?>

</div>
