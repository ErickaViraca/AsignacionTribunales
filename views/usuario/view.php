<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */

$this->title = $model->nombre_usr . " " . $model->apellido_paterno_usr . " " . $model->apellido_materno_usr;
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuario-view">
    <div class="well">
        <h3>Nombre: <?= Html::encode($this->title) ?></h3>
      <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
          'nombre_usr',
          'apellido_paterno_usr',
          'apellido_materno_usr',
          'celular_usr',
          'correo_usr',
          'usuario',
          'activate',
        ],
      ]) ?>
        <div class="text-right">
            <p>
              <?= Html::a('Atras', ['lista_usuario'], ['class' => 'btn btn-success']) ?>
            </p>
        </div>
    </div>
</div>
