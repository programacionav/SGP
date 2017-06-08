<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Docente;
use app\models\Rol;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuario-form">

    <?php $form = ActiveForm::begin(); ?>
	<?php
	$item = ArrayHelper::map(Docente::find()->all(),
    'idDocente',
    function($model) {
        return $model['nombre']." ".$model['apellido'];
    }
	);
	
    $idRolActual=Yii::$app->user->identity->idRol;
    if ($idRolActual === 3) {
		echo $form->field($model, 'idDocente')->dropdownList(
        $item,['prompt'=>'Seleccione...'])->label('Docente');   
    }
    ?>
	
	<?php
	$item = ArrayHelper::map(Rol::find()->all(),
    'idRol',
    function($model) {
        return $model['descripcion'];
    }
	);
    $idRolActual=Yii::$app->user->identity->idRol;
    if ($idRolActual === 3) {
		echo $form->field($model, 'idRol')->dropdownList(
        $item,['prompt'=>'Seleccione...'])->label('Rol');   
    }
     ?>

	<?php
    $idRolActual=Yii::$app->user->identity->idRol;
    if ($idRolActual === 3) {
		echo $form->field($model, 'usuario')->textInput(['maxlength' => true]);  
    }
     ?>

    <?= $form->field($model, 'clave')->passwordInput(['maxlength' => true]) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Modificar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
