<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Correlativa */

$this->title = $model->idMateria1;
$this->params['breadcrumbs'][] = ['label' => 'Correlativas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="correlativa-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'idMateria1' => $model->idMateria1, 'idMateria2' => $model->idMateria2], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'idMateria1' => $model->idMateria1, 'idMateria2' => $model->idMateria2], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idMateria1',
            'idMateria2',
        		'tipo',
        ],
    ]) ?>

</div>
