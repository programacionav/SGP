<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Designado */
$usuario=yii::$app->user->identity;//usuario;
if(isset($usuario) && $usuario->idRol==2){
$this->title = 'Nuevo Designado';
$this->params['breadcrumbs'][] = ['label' => 'Designados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="designado-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'model_dpto' => $model_dpto,
        'id_cursado' => $id_cursado,
    ]) ?>

<?php } ?>

</div>
