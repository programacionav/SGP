<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Materia;
/* @var $this yii\web\View */
/* @var $model app\models\Cursado */
$anioActual=date("Y");//Año actual
$anioCursado=date("Y", strtotime($model->fechaFin));//Año de cursado
$mesCursado=date("m", strtotime($model->fechaFin));
$mesActual = date("m"); // Mes actual

if(isset(yii::$app->user->identity)){
    $usuario=yii::$app->user->identity;
$mat=Materia::find()->where(['idMateria'=>$model->idMateria])->one();
$this->title = 'Cursado N°'.$model->idCursado;


$this->params['breadcrumbs'][] = ['label' => 'Cursados', 'url' => ['index','CursadoSearch[idMateria]'=>$mat->idMateria]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cursado-view">
  <div class="panel panel-default">
    <div class="panel-heading"><?php echo $this->title; ?></div>
    <div class="panel-body">
   <?php
   echo $this->render('../materia/_view', [
     'model'=>$mat,
   ]);
   ?>
 </div>
 </div>
<div class="panel panel-default">
  <div class="panel-heading"><?php echo $this->title; ?></div>
  <div class="panel-body">


<?php
  echo "<table class='table'>";
  echo "<tr>";
  echo "<th>Materia</th><th>Cuatrimestre</th><th>Año Inicio</th><th>Año Fin</th>";
  if($usuario->idRol==2)
  {
      if($anioActual==$anioCursado){
        if($mesActual<=$mesCursado){

      echo "<th>Opciones</th>";
      }
          }

    if($anioActual<$anioCursado){
       echo "<th>Opciones</th>";
    }
  }

  echo "</tr>";
  echo "<tr>";
  //echo "<td>";
  //echo " ".$mat->nombre."<br>";
  //echo "</td>";
  echo "<td>";
  echo " ".$mat->nombre ."<br>";
  ?>

  <?php
  echo "</td>";
  echo "<td>";
  echo " ".$model->cuatrimestre ."<br>";
  echo "</td>";
  echo "<td>";
  echo " ".$model->fechaInicio."<br>";
  echo "</td>";
  echo "<td>";
  echo " ".$model->fechaFin."<br>";
  echo "</td>";
  if($usuario->idRol==2){

    if($anioActual==$anioCursado){
        if($mesActual<=$mesCursado){

echo "<td>";
  echo Html::a('Modificar', ['update', 'id' => $model->idCursado], ['class' => 'btn btn-primary']);
  echo "</td>";
        }
    }else if($anioActual<$anioCursado){
        echo "<td>";
  echo Html::a('Modificar', ['update', 'id' => $model->idCursado], ['class' => 'btn btn-primary']);
  echo "</td>";
    }



  }

  echo "</tr>";
  echo "</table>";
?>
</div>
</div>

 <?php

if($usuario->idRol==2){
        if($anioActual==$anioCursado){
            if($mesActual<=$mesCursado){
                echo Html::a('Nueva Designación',['designado/create','idCursado'=>$model->idCursado],['class' =>'btn btn-success']);
            }

        }else{
    if($anioActual<$anioCursado){

        echo Html::a('Nueva Designación',['designado/create','idCursado'=>$model->idCursado],['class' =>'btn btn-success']);
}
?>


<?php }}}?>
<?="<br>"?>
<?="<br>"?>
<div class="panel panel-default">
  <div class="panel-heading">Designaciones</div>
  <div class="panel-body">
<?=$this->render('_viewdesignado.php', [
    'model' => $model
]); ?>
</div>
</div>
</div>
