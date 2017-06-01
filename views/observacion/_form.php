<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Estadoobservacion;
/* @var $this yii\web\View */
/* @var $model app\models\Observacion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="observacion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'observacion')->textInput(['maxlength' => true]) ?>

    <?php $estadoO = ArrayHelper::map(Estadoobservacion::find()->all(), 'idEstadoO', 'descripcion');?>
    <?= $form->field($model, 'idEstadoO')->dropDownList($estadoO,['prompt'=>'Por favor elija un estado']) ?>


    <?= $form->field($model, 'idUsuario')->textInput() ?>

    <?= $form->field($model, 'idPrograma')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'crear' : 'actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
