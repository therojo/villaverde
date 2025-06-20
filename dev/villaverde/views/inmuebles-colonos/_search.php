<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\InmueblesColonosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inmueble-colonos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'fechaRegistro') ?>

    <?= $form->field($model, 'fechaSalidaColonia') ?>

    <?= $form->field($model, 'estatus') ?>

    <?= $form->field($model, 'alCorriente') ?>

    <?php // echo $form->field($model, 'idColono') ?>

    <?php // echo $form->field($model, 'idInmueble') ?>

    <?php // echo $form->field($model, 'idUsuario') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
