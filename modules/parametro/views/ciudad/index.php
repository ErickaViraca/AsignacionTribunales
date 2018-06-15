<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\parametro\models\CiudadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ciudads';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ciudad-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ciudad', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_ciudad',
            'codigo',
            'nombre',
            'activo:boolean',
            'id_pais',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
