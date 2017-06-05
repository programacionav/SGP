<?php

use yii\helpers\Html;
use yii\data\ActiveDataProvider;
use app\models\Materia;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CursadoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */



//echo Yii::$app->controller->action->id;


$usuario=yii::$app->user->identity;//usuario;
if(isset($usuario)){
$this->params['breadcrumbs'][] = ['label' => 'Cursado', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$mat=Materia::find()->where(['idMateria'=>$model->idMateria])->one();



 echo $this->render('vistaMateria', [
         'model' => $model,//'idMateria'=>$model->idMateria
         'idMateria'=>1
    ]) ;
?>
<div class="cursado-index">



    <?= $this->render('_view', [
        'model' => $model,
    ]) ?>


</div>
<?php }
 ?>
