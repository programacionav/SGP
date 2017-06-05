<?php

use yii\helpers\Html;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CursadoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$usuario=yii::$app->user->identity;//usuario;
if(isset($usuario)){
$this->params['breadcrumbs'][] = ['label' => 'Cursado', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cursado-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_view', [
        'model' => $model,
    ]) ?>
</div>
<?php }
 ?>
