<?php
use yii\helpers\Html;
use app\models\Materia;

/*@var $this CursadoController*/
/*@var $model Cursado*/
$mat=Materia::find()->where(['idMateria'=>$model->idMateria])->one();

    ?>
<div	class="col-md-12">
<p><?php echo Html::encode($model->idCursado)?>

<!--  type, input name, input value, options-->
<?// echo Html::input('text', 'nombre', $mat['nombre']) ?>
<?= Html::encode(($mat['nombre']))	?>

<?php echo Html::encode($model->cuatrimestre)." - "?>
<?php echo Html::encode($model->fechaInicio)." - "?>

<?php echo Html::encode($model->fechaFin)." - "?>


  <?= Html::a('Modificar', ['update', 'id' => $model->idCursado], ['class' => 'btn btn-primary']) ?>
  <?= Html::a('Ver', ['view', 'id' => $model->idCursado], ['class' => 'btn btn-danger']);?>
  <?= Html::a('Crear Programa',['programa/create','idCursado'=>$model->idCursado],['class' =>'btn btn-info']);?>
  <?= "</td>"?>

  <?php echo "<tr>" ?>
	</p></div>
	<?php


	?>
