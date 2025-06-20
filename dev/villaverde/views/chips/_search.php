<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ChipsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="chips-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'numero') ?>

    <?= $form->field($model, 'estatus') ?>

    <?= $form->field($model, 'observaciones') ?>

    <?= $form->field($model, 'fechaRegistro') ?>

    <?php // echo $form->field($model, 'idAuto') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
