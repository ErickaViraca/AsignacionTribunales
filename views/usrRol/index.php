<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsrRolSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usr Rols';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usr-rol-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Usr Rol', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idusr_rol',
            'usuario_idusuario',
            'rol_idrol',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
