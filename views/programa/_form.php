<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Programa */
/* @var $form yii\widgets\ActiveForm */
?>


    <?php $form = ActiveForm::begin(); ?>







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
        <td colspan="2"><div class="col-md-2" style="padding-left: 0px !important;"><strong>ORIENTACION:</strong></div><div class="col-md-10"><?= $form->field($model, 'orientacion')->textInput(['maxlength' => true])->label(false) ?></div></td>
      </tr>
      <tr>
        <td><strong>CARRERA:</strong><?=$model->idCursado0->idMateria0->idPlan0->idCarrera0->nombre?></td>
        <td><strong>PLAN:</strong><?=$model->idCursado0->idMateria0->idPlan0->numOrd?></td>
        <td><strong>AÑO:</strong></td>
      </tr>
      <tr>
        <td colspan="1"><strong>CUATRIMESTRE:</strong><?=$model->idCursado0->cuatrimestre;?></td>
        <td colspan="2"><div class="col-md-1" style="padding-left: 0px !important;"><strong>AÑO:</strong></div><div class="col-md-11"><?= $form->field($model, 'anioActual')->textInput(['maxlength' => true])->label(false) ?></div>
</td>
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
        <td colspan="3"><strong>PROGRAMA ANALÍTICO:</strong><br><?= $form->field($model, 'programaAnalitico')->textarea(['rows' => 6])->label(false) ?>
      </tr>
      <tr>
        <td colspan="3"><strong>PROPUESTA METODOLÓGICA:</strong>  <?= $form->field($model, 'propuestaMetodologica')->textInput(['maxlength' => true])->label(false) ?></td>
      </tr>
      <tr>
        <td colspan="3"><strong>CONDICIONES DE ACREDITACIÓN Y EVALUACIÓN:</strong>    <?= $form->field($model, 'condicionesAcredEvalu')->textInput(['maxlength' => true])->label(false) ?>
</td>
      </tr>
      <tr>
        <td colspan="3"><strong>HORARIOS DE CONSULTA DE ALUMNOS:</strong><br>
        <strong>Docente: (dias y horas)</strong><br>
        <?= $form->field($model, 'horariosConsulta')->textInput(['maxlength' => true])->label(false) ?>

      </td>
      </tr>
      <tr>
        <td colspan="3"><strong>BIBLIOGRAFIA BASICA<br>BIBLIOGRAFIA DE CONSULTA:</strong>    <?= $form->field($model, 'bibliografia')->textInput(['maxlength' => true])->label(false) ?>
</td>
      </tr>

    </tbody>
  </table>
  <div class="form-group">
      <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
  </div>
    <?php ActiveForm::end(); ?>
</div>
