<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Sesiones $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="sesiones-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idTalon')->textInput() ?>

    <?= $form->field($model, 'idUsuario')->textInput() ?>

    <?= $form->field($model, 'createdAt')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
