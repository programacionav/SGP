<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Departamento;
use app\models\Docente;
use app\models\Cargo;

/* @var $this yii\web\View */
/* @var $model app\models\DepartamentoDocenteCargo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="departamento-docente-cargo-form">

	<?php
	$itemDocente = ArrayHelper::map(Docente::find()->all(),
    'idDocente',
    function($model) {
        return $model['nombre'].' '.$model['apellido'];
    }
	);

    $itemDepartamento = ArrayHelper::map(Departamento::find()->all(),
    'idDepartamento',
    function($model) {
        return $model['nombre'];
    }
    );

       $itemCargo = ArrayHelper::map(Cargo::find()->all(),
    'idCargo',
    function($model) {
        return $model['descripcion'];
    }
    );

     ?>

    <?php $form = ActiveForm::begin(); ?>

    <big><b>Docente</b></big>
    <br>

    <?= Html::encode($itemDocente[$model->idDocente])  ?>
     <br>
     <br>  

    <?= $form->field($model, 'idDepartamento')->dropdownList(
        $itemDepartamento,
    ['prompt'=>'Seleccione departamento']
    )->label('Departamento') ?>

    <?=  $form->field($model, 'idCargo')->dropdownList(
        $itemCargo,
    ['prompt'=>'Seleccione el cargo']
    )->label('Cargo') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Asignar' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
