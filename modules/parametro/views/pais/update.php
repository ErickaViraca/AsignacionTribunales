<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\parametro\models\Pais */

$this->title = 'Update Pais: ' . $model->id_pais;
$this->params['breadcrumbs'][] = ['label' => 'Pais', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_pais, 'url' => ['view', 'id' => $model->id_pais]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pais-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
