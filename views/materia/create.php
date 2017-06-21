<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Materia */

$this->title = 'Crear una nueva Materia';
//$this->params['breadcrumbs'][] = ['label' => 'Materias', 'url' => ['index']];crear vista parcial?
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="materia-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
