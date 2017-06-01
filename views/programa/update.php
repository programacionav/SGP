<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Programa */

$this->title = 'Actualizar Programa: ' . $model->idPrograma;
$this->params['breadcrumbs'][] = ['label' => 'Programas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idPrograma, 'url' => ['view', 'id' => $model->idPrograma]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="programa-update">
    <h1><?= Html::encode($this->title) ?></h1>
<!-- en teoria va a traer las obersaciones,falta hacerle muchas cosas a esto-->
<?php
/*
$estado = null;
if(Yii::$app->user->identity->idRol == 1){
  $estado = 1;
  $nombreAccion = "Realizado";
}else{
  $estado = 2;  
  $nombreAccion = "Comprobado";

}
$alert = null;
$cantidad = null;
  foreach ( $model->observacions as $recorre) {
$cantidad = $recorre->find()
    ->where(['idEstadoO' => $estado])// aca tambien deberia detectar el rol del usuario logueado para que cuando se loguee el jefe pueda ver las observaciones corregidas por el docente
     ->andWhere(['idPrograma' => $model->idPrograma])
    ->count();
  }
if ( $cantidad > 0 ){
$alert = "<div class='alert alert-danger'>";
$alert.= "<strong>observaciones</strong><br>";



   foreach ( $model->observacions as $recorre) {

if($recorre->idEstadoO == $estado){//busca segun el estado de la observacion,TAMBIEN,deberia decetectar que rol esta logueado.
  $alert.="<strong>- </strong>".$recorre->observacion.Html::a($nombreAccion,Url::toRoute(['cambioestadoob','id' => $recorre->idObservacion]), ['class' => 'pull-right']) ."<br>";

}

}






}$alert.="</div>"; echo $alert;?>

*/

   echo  $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
