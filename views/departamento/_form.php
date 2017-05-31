<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Docente;
use app\models\Facultad;
use app\models\Departamento;
/* @var $this yii\web\View */
/* @var $model app\models\Departamento */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="departamento-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true])?>



	<?php
	$item = ArrayHelper::map(Docente::find()->all(), //Verficar si funciona
    'idDocente',
    function($model) {
     	return $model['nombre'].' '.$model['apellido']; 
    }
	);

    $itemFacultad = ArrayHelper::map(Facultad::find()->all(),
    'idFacultad',
    function($model) {
        return $model['nombre'];
    }
    );
     ?>


    <?php  
		$docentes = count($item);
		if($docentes==0){
			echo "<label>Director de departamento</label>
				<p>No hay docentes registrados para seleccionar.</p>";
			echo "<p>".Html::a('Registrar nuevo docente', ['/docente/create'], ['class' => 'btn btn-success'])."</p>";	
		}
		else{
			echo $form->field($model, 'idDocente')->dropdownList(
				$item,
			['prompt'=>'Seleccione docente']
			)->label('Director de departamento');
		}
	?>
            

        <?= $form->field($model, 'idFacultad')->dropdownList(
        $itemFacultad,
    ['prompt'=>'Seleccione la facultad']
    )->label('Facultad'); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Modificar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    

    <?php ActiveForm::end(); ?>

</div>
