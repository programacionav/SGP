<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Materia;


/* @var $this yii\web\View */
/* @var $model app\models\Cursado */
/* @var $form yii\widgets\ActiveForm */
use kartik\date\DatePicker;




?>

<div class="cursado-form">
    <?php $form = ActiveForm::begin(); 
     // if(isset($_GET['id'])&&$_GET['id']!="")
    //{$model->idMateria=$_GET['id'];}
    ?>
    <?php
      $item = Materia::find() 
        ->select(['Nombre'])  
        ->indexBy('idMateria')  
        ->column();
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
     <?= $form->field($model, 'fechaInicio')->widget(DatePicker::classname(),[
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
     <?= $form->field($model, 'idMateria')->dropdownList(
        $item,
    ['prompt'=>'Elija materia']
    ); ?>
   

   

	
	<?php 
	
	$itemCuatrimestre=['1'=>'Primer Cuatrimestre','2'=>'Segundo Cuatrimestre'];?>
	<?= $form->field($model, 'cuatrimestre')->dropdownList($itemCuatrimestre,
			['prompt'=>'seleccione cuatrimestre']) ;
	?>
	

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
