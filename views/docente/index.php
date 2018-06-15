<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DocentesoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lista de docentes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="docente-index">
     <h3 class="text-center"><?= Html::encode($this->title) ?></h3>
    <div class="well">
       
    </div>
    
    <h1></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Docente', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'iddocente',
            'nombre_doc',
            'paterno_doc',
            'materno_doc',
            'telefono_doc',
            'titulo_doc',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
