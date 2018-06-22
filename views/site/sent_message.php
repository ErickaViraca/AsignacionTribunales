<?php
use yii\helpers\Html;
$this->title = 'MESSAGE SENT';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1 class="text-success"><?= Html::encode($this->title) ?></h1>
    <hr>
    <hr>

    <p> <b>From: </b> <? echo $from ?> <br>
    	<b>To: </b> <?echo $to?> <br>
    	<b>Subject: </b> <?echo $subject?>
		<br>
		<b>MESSAGE</b>
		<hr>

		<div class="col-md-6">
        	<?echo $body?>
        </div>
        
        <br>
        <br>
        <br>
        <br>
        <br>
        <hr><hr>
        
    </p>

    <a  class="btn btn-success col-md-2" href="./index.php">OK</a>
</div>