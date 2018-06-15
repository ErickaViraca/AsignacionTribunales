<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RolMenu */

$this->title = 'Update Rol Menu: ' . $model->idrol_menu;
$this->params['breadcrumbs'][] = ['label' => 'Rol Menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idrol_menu, 'url' => ['view', 'idrol_menu' => $model->idrol_menu, 'rol_idrol' => $model->rol_idrol, 'menu_idmenu' => $model->menu_idmenu]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rol-menu-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
