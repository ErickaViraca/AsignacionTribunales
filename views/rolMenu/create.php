<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RolMenu */

$this->title = 'Create Rol Menu';
$this->params['breadcrumbs'][] = ['label' => 'Rol Menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rol-menu-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
