<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Carrera */

$this->title = 'Modificar Carrera '; 
$this->params['breadcrumbs'][] = ['label' => 'Carreras', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->idCarrera, 'url' => ['view', 'id' => $model->idCarrera]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="carrera-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
