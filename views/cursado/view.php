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

$this->title =  $mat->nombre;


$this->params['breadcrumbs'][] = ['label' => 'Cursados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;




 echo $this->render('vistaMateria', [
         'model' => $model,'idMateria'=>$model->idMateria
    ]) ;
?>
<div class="cursado-view">


 <p>
<?php

  echo "<table class='table'>";
  echo "<tr>";
  echo "<th>ID Cursado</th><th>Cuatrimestre</th><th>Año Inicio</th><th>Año Fin</th>";
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
  echo "<td>";
  echo " ".$model->idCursado."<br>";
  echo "</td>";
  //echo "<td>";
  //echo " ".$mat->nombre."<br>";
  //echo "</td>";
  echo "<td>";
  echo " ".(($model->cuatrimestre == '1')?"Primero":"Segundo")."<br>";
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

<?=$this->render('_viewdesignado.php', [
    'model' => $model
]); ?>

</div>
