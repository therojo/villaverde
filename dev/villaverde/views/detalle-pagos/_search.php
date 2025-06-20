<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\DetallePagosSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="detalle-pagos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'monto') ?>

    <?= $form->field($model, 'estatus') ?>

    <?= $form->field($model, 'observaciones') ?>

    <?= $form->field($model, 'idPago') ?>

    <?php // echo $form->field($model, 'idMes') ?>

    <?php // echo $form->field($model, 'idEjercicio') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
