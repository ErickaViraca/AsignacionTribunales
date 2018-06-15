<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\UsrRol */

$this->title = 'Create Usr Rol';
$this->params['breadcrumbs'][] = ['label' => 'Usr Rols', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usr-rol-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
