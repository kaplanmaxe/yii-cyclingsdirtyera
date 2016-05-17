<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\controllers\CyclistsController;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CyclistsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cyclists';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cyclists-index">
    <p><?= $cyclist_name ?></p>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Cyclists', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'cyclist_id',
            'cyclist_name',
            'cyclist_doper',
            'cyclist_banned',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
