<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Cyclists */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cyclists-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cyclist_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cyclist_doper')->textInput() ?>

    <?= $form->field($model, 'cyclist_banned')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
