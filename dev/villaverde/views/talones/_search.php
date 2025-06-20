<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TalonesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="talones-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'numero') ?>

    <?= $form->field($model, 'folioInicial') ?>

    <?= $form->field($model, 'folioFinal') ?>

    <?= $form->field($model, 'ejercicio') ?>

    <?php // echo $form->field($model, 'estatus') ?>

    <?php // echo $form->field($model, 'fechaRegistro') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
