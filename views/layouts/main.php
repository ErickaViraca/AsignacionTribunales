<?php

/* @var $this \yii\web\View */

/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
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
    'brandLabel' => 'Asignacion Tribunales',
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
      'class' => 'navbar-inverse navbar-fixed-top',
    ],
  ]);
  echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => [
      ['label' => 'Inicio', 'url' => ['/site/index']],
      ['label' => 'Contacto', 'url' => ['/site/contact']],
      Yii::$app->user->isGuest ? (
      ['label' => 'Usur-Sis', 'url' => ['/site/login']]
      ) : (
        '<li>'
        . Html::beginForm(['/site/logout'], 'post')
        . Html::submitButton(
          'Usur-Sis (' . Yii::$app->user->identity->usuario . ')',
          ['class' => 'btn btn-link logout']
        )
        . Html::endForm()
        . '</li>'
      )
    ],
  ]);
  NavBar::end();
  ?>

    <div class="container">
        <div class="col-lg-3 col-md-3 col-sm-3">
            <div class="row">
              <?php
              if (!Yii::$app->user->isGuest) {
                echo \app\components\widgets\userMenu::widget();
              }
              ?>
            </div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-9">
          <?= $content ?>
        </div>

    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; FCYT</p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
