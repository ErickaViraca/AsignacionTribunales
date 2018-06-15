<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\UsrRol */

$this->title = $model->idusr_rol;
$this->params['breadcrumbs'][] = ['label' => 'Usr Rols', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usr-rol-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'idusr_rol' => $model->idusr_rol, 'usuario_idusuario' => $model->usuario_idusuario, 'rol_idrol' => $model->rol_idrol], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'idusr_rol' => $model->idusr_rol, 'usuario_idusuario' => $model->usuario_idusuario, 'rol_idrol' => $model->rol_idrol], [
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
            'idusr_rol',
            'usuario_idusuario',
            'rol_idrol',
        ],
    ]) ?>

</div>
