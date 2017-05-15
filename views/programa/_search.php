<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProgramaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="programa-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idPrograma') ?>

    <?= $form->field($model, 'idCursado') ?>

    <?= $form->field($model, 'orientacion') ?>

    <?= $form->field($model, 'anioActual') ?>

    <?= $form->field($model, 'programaAnalitico') ?>

    <?php // echo $form->field($model, 'propuestaMetodologica') ?>

    <?php // echo $form->field($model, 'condicionesAcredEvalu') ?>

    <?php // echo $form->field($model, 'horariosConsulta') ?>

    <?php // echo $form->field($model, 'bibliografia') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
