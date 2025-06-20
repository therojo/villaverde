<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\DetallePagos $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="detalle-pagos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'monto')->textInput() ?>

    <?= $form->field($model, 'estatus')->dropDownList([ 'activo' => 'Activo', 'cancelado' => 'Cancelado', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'observaciones')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idPago')->textInput() ?>

    <?= $form->field($model, 'idMes')->textInput() ?>

    <?= $form->field($model, 'idEjercicio')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
