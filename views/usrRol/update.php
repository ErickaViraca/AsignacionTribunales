<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UsrRol */

$this->title = 'Update Usr Rol: ' . $model->idusr_rol;
$this->params['breadcrumbs'][] = ['label' => 'Usr Rols', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idusr_rol, 'url' => ['view', 'idusr_rol' => $model->idusr_rol, 'usuario_idusuario' => $model->usuario_idusuario, 'rol_idrol' => $model->rol_idrol]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="usr-rol-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
