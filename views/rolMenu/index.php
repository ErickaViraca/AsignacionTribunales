<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RolMenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rol Menus';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rol-menu-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Rol Menu', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idrol_menu',
            'rol_idrol',
            'menu_idmenu',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
