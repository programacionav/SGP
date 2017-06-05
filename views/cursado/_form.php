<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\Cursado */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="cursado-form">
   <?php $form = ActiveForm::begin(); 
     if(isset($_GET['idMateria'])&&$_GET['idMateria']!="")
    {$model->idMateria=$_GET['idMateria'];}
    ?>
    <?php
    if(isset(yii::$app->user->identity)){

        $usuario=yii::$app->user->identity;
        $rol=$usuario->idRol;

        if($rol==2){




 echo $form->field($model, 'fechaInicio')->widget(DatePicker::classname(),[
    'name' => 'fechaInicio',
	'id'=>'fechaInicio',
    'type' => DatePicker::TYPE_COMPONENT_PREPEND,
    'value' => '23-12-2017',
    'pluginOptions' => [
        'autoclose'=>true,
        'format' => 'yyyy-mm-dd'
    ]
]);
     ?>
     
      
    <?= $form->field($model, 'fechaFin')->widget(DatePicker::classname(),[
    		'name' => 'fechaFin',
    		'id'=>'fechaFin',
    		'type' => DatePicker::TYPE_COMPONENT_PREPEND,
    		'value' => '23-12-2017',
    		'pluginOptions' => [
    				'autoclose'=>true,
    				'format' => 'yyyy-mm-dd'
    		]
    ]);
    
    ?>
     
     
     <?= $form->field($model, 'idMateria')->hiddenInput()->label(""); ?>
   

   

	
	<?php 
	
	$itemCuatrimestre=['1'=>'Primer Cuatrimestre','2'=>'Segundo Cuatrimestre'];?>
	<?= $form->field($model, 'cuatrimestre')->dropdownList($itemCuatrimestre,
			['prompt'=>'seleccione cuatrimestre']) ;
	?>
	

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Modificar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php     }

    }



    ?>
    

    <?php ActiveForm::end(); ?>

</div>