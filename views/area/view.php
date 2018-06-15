<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Area */

$this->title = $model->nombre_area;
$this->params['breadcrumbs'][] = ['label' => 'Areas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="area-view">
    <div class="well">
        <h3>Area: <?= Html::encode($this->title) ?></h3>
      <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
          'idarea',
          'nombre_area',
          'descripcion_area',
          'area_idarea',
        ],
      ]) ?>
        <p class="text-right ">
          <?= Html::a('Atras', ['lista_area'], ['class' => 'btn btn-success']) ?>
        </p>
    </div>
</div>
