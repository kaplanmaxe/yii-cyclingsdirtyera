<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CyclistsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cyclists-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'cyclist_id') ?>

    <?= $form->field($model, 'cyclist_name') ?>

    <?= $form->field($model, 'cyclist_doper') ?>

    <?= $form->field($model, 'cyclist_banned') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
