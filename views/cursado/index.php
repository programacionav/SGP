<?php

use yii\helpers\Html;
use yii\data\ActiveDataProvider;
use app\models\Materia;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CursadoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
<<<<<<< HEAD
=======


//echo Yii::$app->controller->action->id;
>>>>>>> 7bb4f9d222367f2aa21e3816df8a8a63e30e903a

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
