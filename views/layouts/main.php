<?php

/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);

$pageIndex = Yii::$app->getHomeUrl() . '?r=site/login';
$menu = array();
if(!Yii::$app->user->isGuest){
    $pageIndex = Yii::$app->getHomeUrl() . '?r=programa/index';
    $menu = [
            ['label' => 'Docentes', 'url' => ['/docente/index']],
            ['label' => 'Departamentos', 'url' => ['/departamento/index']],
            ['label' => 'Carreras', 'url' => ['/carrera/index']],
            ['label' => 'Programas', 'url' => ['/programa/index']],
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )];
}

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php


    NavBar::begin([
        'brandLabel' => 'SGP',
        'brandUrl' => $pageIndex,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menu,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        
        <?= Breadcrumbs::widget([
        'homeLink' => ['label' => 'Inicio',
        'url' => $pageIndex],
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [], 
    ]);?>
       
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">
        &copy; Universidad Nacional del Comahue - Facultad de Informática <br>
        &nbsp;&nbsp;&nbsp;&nbsp;Programación Web Avanzada 2017</p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
