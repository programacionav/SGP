<?php
use yii\web\View;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use app\models\Usuario;
use app\models\Rol;



/* @var $this yii\web\View */
/* @var $model app\models\Programa */



$this->title = $model->idPrograma;
$this->params['breadcrumbs'][] = ['label' => 'Programas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->getTitulo();
?>






<?php
echo $model->aprobado();
//determina el idEstado segun el rol logueado.
$estado = null;
$nombreAccion = null;
if(Rol::findOne(Yii::$app->user->identity->idRol)->esDocente()){
  $estado = 1;
  $nombreAccion = "Realizado";
}elseif(Rol::findOne(Yii::$app->user->identity->idRol)->esJefeDpto()){
  $estado = 2;
  $nombreAccion = "Comprobado";

}
//realiza la busqueda para saber si hay observaciones
$cantidad = null;
foreach ( $model->observacions as $recorre) {
  $cantidad = $recorre->find()
  ->where(['idEstadoO' => $estado])
  ->andWhere(['idPrograma' => $model->idPrograma])
  ->count();
}
?>

<div class="programa-view container-fluid">
  <div class="page-header">
    <h3 class="text-center"><?= $model->getTitulo() ?></h3>
  </div>
  <div class="row">
    <div class="well well-lg">
      <?php

      foreach ( Yii::$app->user->identity->idDocente0->designados as $recorre2) {
        if ($recorre2->esACargo() == true){
          if($model->enRevision() == false){
          echo Html::a('<span class="glyphicon glyphicon-pencil"></span>&nbsp;Actualizar', ['update', 'id' => $model->idPrograma], ['class' => 'btn btn-default']);
          }
          echo Html::a('<span class="glyphicon glyphicon-trash"></span>&nbsp;Borrar', ['delete', 'id' => $model->idPrograma], [
            'class' => 'btn btn-default',
            'data' => [
              'confirm' => '¿Esta seguro que desea eliminar el programa?',
              'method' => 'post',
            ],
          ]);
        }
      }
      ?>

      <?php
      //BOTON REVISION
      if($cantidad == 0 & Rol::findOne(Yii::$app->user->identity->idRol)->esDocente() ){
        if($model->enRevision() == false){
        echo  Html::a('<span class="glyphicon glyphicon-ok"></span>&nbsp;Revision', Url::toRoute(['cambiarestado','idPrograma' => $model->idPrograma]), [
          'class' => 'btn btn-success',
          'data' => [
            'confirm' => 'Esta seguro que desea poner en revision este programa?'],
          ]);}
      }
          if(Rol::findOne(Yii::$app->user->identity->idRol)->esDocente() == false){
            Modal::begin([
              'header' => 'Nueva observación',
              'headerOptions' => ['class' => 'text-center'],
              'toggleButton' => ['label' => '<span class="glyphicon glyphicon-plus"></span>&nbsp;Observación','class'=>'btn btn-default'],
            ]);
            echo '<div class="row">';
            echo '<div class="col-xs-12">';
            $form = ActiveForm::begin();
            echo '<div class="form-group">';
            echo '<label>Observación</label>';
            echo HTML::textArea('observacion',null,['id' => 'texto-observacion','class' => 'form-control']);
            echo '</div>';
            echo '<div class="form-group">';
            echo '<button type="button" onclick="ctrl.observacion.nueva()"><span class="glyphicon glyphicon-plus"></span>&nbsp;Agregar</button>';
            echo '</div>';
            ActiveForm::end();
            echo '</div>';
            echo '</div>';

            Modal::end();
            ?>

            <?php
              if(Rol::findOne(Yii::$app->user->identity->idRol)->esJefeDpto() && $model->existeObservacionRevison())  {
                echo  Html::a('<span class="glyphicon glyphicon-refresh"></span>&nbsp;Reabrir', Url::toRoute(['cambiarestado','idPrograma' => $model->idPrograma,'id' => 1]), [
                  'class' => 'btn btn-default',
                  'data' => [
                    'confirm' => '¿Esta seguro que desea reabrir este programa?'],
                  ]);
                echo '&nbsp;';
              }
              if($cantidad == 0){
                echo  Html::a('<span class="glyphicon glyphicon-ok"></span>&nbsp;Aprobar', Url::toRoute(['cambiarestado','idPrograma' => $model->idPrograma]), [
                  'class' => 'btn btn-success',
                  'data' => [
                    'confirm' => 'Esta seguro que desea aprobar este programa?'],
                  ]);} }

            ?>
                <?= Html::a('<span class="glyphicon glyphicon-export"></span>&nbsp;Crear pdf',Url::toRoute(['programa/report','id' => $model->idPrograma]), ['class' => 'btn btn-default pull-right','target'=>'_blank']) ?>
              </div>
            </div>

            <?php

            $alert = null;

            if ( $cantidad > 0 ){
              $alert = "<div class='alert alert-danger'>";
              $alert.= "<strong>observaciones</strong><br>";



              foreach ( $model->observacions as $recorre) {

                if($recorre->idEstadoO == $estado){//busca segun el estado de la observacion,TAMBIEN,deberia decetectar que rol esta logueado.
                  $alert.="<strong>- </strong>".$recorre->observacion.Html::a($nombreAccion,Url::toRoute(['cambioestadoob','id' => $recorre->idObservacion]), ['class' => 'pull-right']) ."<br>";

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

          <script>


          var ctrl = {
            idPrograma:'<?= $model->idPrograma ?>',
            observacion:{
              textarea:$('#texto-observacion'),
              nueva:function(){
                var observacion = ctrl.observacion.textarea.val();
                $.ajax({
                  url:'index.php?r=observacion/abmobservacion',
                  method:'POST',
                  data:{
                    action:'insert',
                    observacion:observacion,
                    idPrograma:ctrl.idPrograma,
                  },
                  dataType:'json',
                  success:function(response){
                    if(response.success){
                      alert("Observación agregada exitosamente");
                      window.location.href = "";
                    }else{
                      if(response.errors.length > 0){
                        alert(response.errors[0]);
                      }else{
                        alert("Ocurrió un error desconocido al agregar la observación");
                      }
                    }
                  }
                });
              },
              actualizar:function(){

              },
              borrar:function(){

              }
            }
          };

          </script>
