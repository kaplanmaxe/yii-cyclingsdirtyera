<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cyclists */

$this->title = 'Update Cyclists: ' . $model->cyclist_id;
$this->params['breadcrumbs'][] = ['label' => 'Cyclists', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->cyclist_id, 'url' => ['view', 'id' => $model->cyclist_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cyclists-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
