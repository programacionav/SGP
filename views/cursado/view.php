<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Materia;
/* @var $this yii\web\View */
/* @var $model app\models\Cursado */
$mat=Materia::find()->where(['idMateria'=>$model->idMateria])->one();
$this->title = "Cursado N°".$model->idCursado;


$this->params['breadcrumbs'][] = ['label' => 'Cursados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cursado-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>

   <!--      <?php /*= Html::a('Update', ['update', 'id' => $model->idCursado], ['class' => 'btn btn-primary']) ?>
        <?php echo Html::a('Delete', ['delete', 'id' => $model->idCursado], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) */
        ?>
       <?//echo  Html::a('Crear Programa',['programa/create','idCursado'=>$model->idCursado],['class' =>'btn btn-info']);?>
    </p> -->
<?php
  echo "<table class='table'>";
  echo "<tr>";
  echo "<td>";
  echo "ID Cursado: ".$model->idCursado."<br>";
  echo "</td>";
  echo "<td>";
  echo "Materia: ".$mat->nombre."<br>";
  echo "</td>";
  echo "<td>";
  echo "Cuatrimestre: ".(($model->cuatrimestre == '1')?"Primero":"Segundo")."<br>";
  echo "</td>";
  echo "<td>";
  echo "Fecha Inicio: ".$model->fechaInicio."<br>";
  echo "</td>";
  echo "<td>";
  echo "Fecha Fin: ".$model->fechaFin."<br>";
  echo "</td>";
  echo "<td>";
  echo Html::a('Modificar', ['update', 'id' => $model->idCursado], ['class' => 'btn btn-primary']);
  echo "</td>";
  echo "<td>";
  echo "</tr>";
  echo "</table>";
?>
    <?/* DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idCursado',
            'fechaInicio',
            'fechaFin',

            'cuatrimestre',
        ],
    ]) */?>

</div>
