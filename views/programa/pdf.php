<?php
use yii\helpers\Html;
use app\models\Materia;


 ?>
<?= Html::img('@web/logo.png', ['alt' => 'My logo']) ?>
<div style="margin-top:15px;"></div>

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
                     <?php
                    foreach($model->idCursado0->idMateria0->correlativas as $recorre3){
                          if($recorre3->tipo == "Cursado"){
                             $cantidad2 = Materia::find()
                    ->where(['idMateria' => $recorre3->idMateria2])->one();
                      echo   $cantidad2['nombre'];
                      echo "<br>";
}
                          }
                          
                    
                   
                    ?>
                    
                    <br>
                    <strong>Aprobadas:</strong><br>
                    <?php
                    foreach($model->idCursado0->idMateria0->correlativas as $recorre3){
                          if($recorre3->tipo == "Aprobado"){
                             $cantidad2 = Materia::find()
                    ->where(['idMateria' => $recorre3->idMateria2])->one();
                      echo   $cantidad2['nombre'];
                      echo "<br>";
}
                          }
                          
                    
                   
                    ?>
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
  <tr>
    <td valign="bottom" colspan="1" style="padding-top:80px"><strong>FIRMA DEL PROFESOR</strong></td>
    <td valign="bottom" colspan="1" style="padding-top:80px"><strong>FIRMA DEL DIRECTOR DEL DEPARTAMENTO</strong></td>
    <td valign="bottom" colspan="1" style="padding-top:80px"><strong>FIRMA DE SECRETARIA ACADEMICA</strong></td>
  </tr>

</tbody>
</table>
