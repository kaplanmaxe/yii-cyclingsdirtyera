<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Cyclists */

$this->title = 'Create Cyclists';
$this->params['breadcrumbs'][] = ['label' => 'Cyclists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cyclists-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
