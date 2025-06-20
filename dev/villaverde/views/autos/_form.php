<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Autos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="autos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'modelo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'placas')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idInmuebleColono')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
