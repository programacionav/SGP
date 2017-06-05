<?php 
use yii\helpers\Html;
use app\models\Materia;
use app\models\Departamento;
use app\models\Plan;
use yii\data\ActiveDataProvider;



$queryMateria=Materia::find()->where(['idMateria'=>$idMateria])->One();
 echo "<h1>".Html::encode($queryMateria['nombre'])."</h1>";
$queryDpto=Departamento::find()->where(['idDepartamento'=>$queryMateria['idDepartamento']])->One();


$queryPlan=Plan::find()->where(['idPlan'=>$queryMateria['idPlan']])->One();

//<?=($queryMateria['nombre'])
?>
<table class='table'>
<tr><th>Código</th><th>Descripción</th><th>Departamento</th></tr>
<tr><td><?= ($queryMateria['codigo']);?></td><td><?="<br>Plan N°Ordenanza:".($queryPlan['numOrd']);?></td><td><?=($queryDpto['nombre']);?></td></tr>

</table>