<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Dedicacion;
use app\models\Rol;

/* @var $this yii\web\View */
/* @var $model app\models\Docente */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="docente-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cuil')->textInput(['maxlength' => 11]);echo "<p style='color:red'>".$mensaje."</p>" ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apellido')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mail')->textInput(['maxlength' => true]) ?>

	<?php
	$item = ArrayHelper::map(Dedicacion::find()->all(),
    'idDedicacion',
    function($model) {
        return $model['descripcion'];
    }
	);
     ?>
    <?= $form->field($model, 'idDedicacion')->dropdownList(
        $item,
    ['prompt'=>'Seleccione...']
    )->label('Dedicacion'); ?>

    <?= 'Rol por defecto: Rol docente';/* $form->field($modelUsuario, 'idRol')->dropdownList(
        $item,
    ['prompt'=>'Seleccione...']
    )->label('Rol'); */?>



    <div class="form-group">
       <br>
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Modificar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
