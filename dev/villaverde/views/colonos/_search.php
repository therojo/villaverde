<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ColonosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="colonos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'apellido1') ?>

    <?= $form->field($model, 'apellido2') ?>

    <?= $form->field($model, 'telefono') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'fechaRegistro') ?>

    <?php // echo $form->field($model, 'fechaSalida') ?>

    <?php // echo $form->field($model, 'estatus') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
