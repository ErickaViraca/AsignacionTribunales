<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lista de usuario';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuario-index">
     <h3 class="text-center"><?= Html::encode($this->title) ?></h3>
    <div class="well">
       
    </div>
    
    <h1></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Usuario', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'idusuario',
            'nombre_usr',
            'apellido_paterno_usr',
            'apellido_materno_usr',
            'celular_usr',
            // 'correo_usr',
            // 'usuario',
            // 'contrasenia',
            // 'conf_contrasenia',
            // 'activate',
            // 'accessToken',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
