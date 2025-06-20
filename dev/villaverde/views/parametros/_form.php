<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Parametros $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="parametros-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cuota')->textInput() ?>

    <?= $form->field($model, 'estatus')->dropDownList([ 'activo' => 'Activo', 'inactivo' => 'Inactivo', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'createdAt')->textInput() ?>

    <?= $form->field($model, 'updatedAt')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
