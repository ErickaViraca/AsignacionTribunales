<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\RolMenu */

$this->title = $model->idrol_menu;
$this->params['breadcrumbs'][] = ['label' => 'Rol Menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rol-menu-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'idrol_menu' => $model->idrol_menu, 'rol_idrol' => $model->rol_idrol, 'menu_idmenu' => $model->menu_idmenu], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'idrol_menu' => $model->idrol_menu, 'rol_idrol' => $model->rol_idrol, 'menu_idmenu' => $model->menu_idmenu], [
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
            'idrol_menu',
            'rol_idrol',
            'menu_idmenu',
        ],
    ]) ?>

</div>
