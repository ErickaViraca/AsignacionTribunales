<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AreasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lista de areas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="area-index">
     <h3 class="text-center"><?= Html::encode($this->title) ?></h3>
    <div class="well">
       
    </div>
    
    <h1></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Area', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'idarea',
            'nombre_area',
            'descripcion_area',
            'area_idarea',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
