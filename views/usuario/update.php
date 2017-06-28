<?php

use yii\helpers\Html;
use app\models\Docente;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */

$item = ArrayHelper::map(Docente::find()->all(),
'idDocente',
function($model) {
   return $model['nombre']." ".$model['apellido'];
}
);
$this->title = 'Modificar Usuario de: ' . $item[$model->idDocente];
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model['usuario'], 'url' => ['view', 'id' => $model->idUsuario]];
$this->params['breadcrumbs'][] = 'Modificar Usuario';
?>
<div class="usuario-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
