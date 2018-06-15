<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\empleado\models\Empleado */

$this->title = 'Create Empleado';
$this->params['breadcrumbs'][] = ['label' => 'Empleados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="empleado-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
