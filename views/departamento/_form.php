<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Docente;

/* @var $this yii\web\View */
/* @var $model app\models\Departamento */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="departamento-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true])?>

    

	<?php
	$item = ArrayHelper::map(Docente::find()->all(),
    'idDocente',
    function($model) {
        return $model['nombre'].' '.$model['apellido'];
    }
	);
     ?>
    <?= $form->field($model, 'idDocente')->dropdownList(
        $item,
    ['prompt'=>'Seleccione docente']
    )->label('Director de departamento'); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Modificar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

