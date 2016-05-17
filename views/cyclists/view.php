<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Cyclists */

$this->title = $model->cyclist_id;
$this->params['breadcrumbs'][] = ['label' => 'Cyclists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cyclists-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->cyclist_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->cyclist_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'cyclist_id',
            'cyclist_name',
            'cyclist_doper',
            'cyclist_banned',
        ],
    ]) ?>

</div>
