<?php

use yii\helpers\Html;
use yii\helpers\Url;



/* @var $this yii\web\View */
/* @var $model app\models\Programa */

$this->title = 'Crear Programa';
$this->params['breadcrumbs'][] = ['label' => 'Programas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php echo $cantidad = $model->find()
    ->where(['idCursado' => $model->idCursado])
    ->count();?>

<?php
if($cantidad > 0 ) {
echo  Html::a('Ultimo Programa',Url::toRoute(['programa/create','bLastPrograma' =>1]), ['class' => 'btn btn-primary pull-right']);

}
?>


<div class="programa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
