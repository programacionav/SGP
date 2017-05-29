<?php

use yii\helpers\Html;
use app\models\Materia;
$mat=Materia::find()->where(['idMateria'=>$model->idMateria])->one();

/* @var $this yii\web\View */
/* @var $model app\models\Cursado */

$this->title = 'Update Cursado: ' . $model->idCursado;
$this->params['breadcrumbs'][] = ['label' => 'Cursados', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idCursado, 'url' => ['view', 'id' => $model->idCursado]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cursado-update">

    <h1><?= Html::encode($mat['nombre']) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
