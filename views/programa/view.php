<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\bootstrap\Modal;


/* @var $this yii\web\View */
/* @var $model app\models\Programa */

$this->title = $model->idPrograma;
$this->params['breadcrumbs'][] = ['label' => 'Programas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->getTitulo();
?>
<div class="programa-view container-fluid">
    <div class="page-header">
      <h3 class="text-center"><?= $model->getTitulo() ?></h3>
    </div>
    <div class="row">
      <div class="well well-lg">
        <?= Html::a('<span class="glyphicon glyphicon-pencil"></span>&nbsp;Actualizar', ['update', 'id' => $model->idPrograma], ['class' => 'btn btn-default']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-trash"></span>&nbsp;Borrar', ['delete', 'id' => $model->idPrograma], [
            'class' => 'btn btn-default',
            'data' => [
                'confirm' => '¿Esta seguro que desea eliminar el programa?',
                'method' => 'post',
            ],
        ]) ?>
        <?php
          Modal::begin([
            'header' => 'Nueva observación',
            'toggleButton' => ['label' => '<span class="glyphicon glyphicon-plus"></span>&nbsp;Observación','class'=>'btn btn-default'],
          ]);
          Modal::end();
        ?>
        <?= Html::a('<span class="glyphicon glyphicon-ok"></span>&nbsp;Aprobar', Url::toRoute(['cambiarestado','idPrograma' => $model->idPrograma]), [
            'class' => 'btn btn-success',
            'data' => [
                    'confirm' => 'Esta seguro que desea aprobar este programa?'],
                    ]) ?>
        <?= Html::a('<span class="glyphicon glyphicon-export"></span>&nbsp;Crear pdf',Url::toRoute(['programa/report','id' => $model->idPrograma]), ['class' => 'btn btn-default pull-right','target'=>'_blank']) ?>
      </div>
    </div>
<!--
     DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idPrograma',
            'idCursado',
            'orientacion',
            'anioActual',
            'programaAnalitico:ntext',
            'propuestaMetodologica',
            'condicionesAcredEvalu',
            'horariosConsulta',
            'bibliografia',
        ],
    ])
-->
<!-- en teoria va a traer las obersaciones,falta hacerle muchas cosas a esto-->
<?php
$alert = null;
$cantidad = null;
  foreach ( $model->observacions as $recorre) {
$cantidad = $recorre->find()
    ->where(['idEstadoO' => 1])// aca tambien deberia detectar el rol del usuario logueado para que cuando se loguee el jefe pueda ver las observaciones corregidas por el docente
     ->andWhere(['idPrograma' => $model->idPrograma])
    ->count();
  }
if ( $cantidad > 0 ){
$alert = "<div class='alert alert-danger'>";
$alert.= "<strong>observaciones</strong><br>";



   foreach ( $model->observacions as $recorre) {

if($recorre->idEstadoO == 1){//busca segun el estado de la observacion,TAMBIEN,deberia decetectar que rol esta logueado.
  $alert.="<strong>- </strong>".$recorre->observacion.Html::a('Realizado',Url::toRoute(['cambioestadoob','id' => $recorre->idObservacion]), ['class' => 'pull-right']) ."<br>";

}

}






}$alert.="</div>"; echo $alert;?>

    <table class="table table-bordered">
    <tbody>
      <tr>
        <td colspan="3"><strong>ASIGNATURA:</strong><?=$model->idCursado0->idMateria0->nombre?></td>
      </tr>
      <tr>
        <td colspan="3"><strong>DEPARTAMENTO:</strong><?=$model->idCursado0->idMateria0->idDepartamento0->nombre?></td>
      </tr>
      <tr>
        <td colspan="1"><strong>AREA:</strong></td>
        <td colspan="2"><strong>ORIENTACION:</strong><?=$model->orientacion;?></td>
      </tr>
      <tr>
        <td><strong>CARRERA:</strong><?=$model->idCursado0->idMateria0->idPlan0->idCarrera0->nombre?></td>
        <td><strong>PLAN:</strong><?=$model->idCursado0->idMateria0->idPlan0->numOrd?></td>
        <td><strong>AÑO:</strong></td>
      </tr>
      <tr>
        <td colspan="1"><strong>CUATRIMESTRE:</strong><?=$model->idCursado0->cuatrimestre;?></td>
        <td colspan="2"><strong>AÑO:</strong><?=$model->anioActual;?></td>
      </tr>
      <tr>
        <td colspan="3"><strong>CORRELATIVAS:</strong><br>
        <strong>Cursadas:</strong><br>
      <strong>Aprobadas:</strong>
      </td>
      </tr>
      <tr>
        <td colspan="3"><strong>EQUIPO DE CÁTEDRA:</strong><br>
          <strong>Listado de Docentes:</strong>
         <?php foreach($model->idCursado0->idDocentes as $recorre2){
           echo $recorre2->nombre." ".$recorre2->apellido."<br>";
         }
           ?>
      </td>
      </tr>
      <tr>
        <td colspan="3"><strong>HORAS DE CLASE:</strong><?=$model->idCursado0->idMateria0->hora?></td>
      </tr>
      <tr>
        <td colspan="3"><strong>OBJETIVOS DE LA MATERIA:</strong><?=$model->idCursado0->idMateria0->objetivo?></td>
      </tr>
      <tr>
        <td colspan="3"><strong>CONTENIDOS MINIMOS:</strong><?=$model->idCursado0->idMateria0->contenidoMinimo?></td>
      </tr>
      <tr>
        <td colspan="3"><strong>PROGRAMA ANALÍTICO:</strong><br><?=$model->programaAnalitico;?>
      </tr>
      <tr>
        <td colspan="3"><strong>PROPUESTA METODOLÓGICA:</strong><?=$model->propuestaMetodologica;?></td>
      </tr>
      <tr>
        <td colspan="3"><strong>CONDICIONES DE ACREDITACIÓN Y EVALUACIÓN:</strong><?=$model->condicionesAcredEvalu;?></td>
      </tr>
      <tr>
        <td colspan="3"><strong>HORARIOS DE CONSULTA DE ALUMNOS:</strong><br>
        <strong>Docente: (dias y horas)</strong><br>
        <?=$model->horariosConsulta;?>
      </td>
      </tr>
      <tr>
        <td colspan="3"><strong>BIBLIOGRAFIA BASICA<br>BIBLIOGRAFIA DE CONSULTA:</strong><?=$model->bibliografia;?></td>
      </tr>

    </tbody>
  </table>


</div>


</div>
