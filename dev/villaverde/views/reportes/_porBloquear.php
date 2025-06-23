<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;

/** @var yii\web\View $this */
/** @var app\models\Egresos $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="box box-success">
    <!-- form start -->
    <?php $form = ActiveForm::begin(); ?>

    <div class="box-body">
        <div class="row">
            <div class="col-md-1">
                <div class="form-group">
                    <i class="fa fa-cut fa-4x"></i>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <?php echo $form->field($model, 'mesesParaBloqueo')->textInput(['maxlength' => true, 'placeholder' => 'Ingrese Número de meses'])->label('Número de Meses para bloqueo') ?>
                </div>
            </div>

            <div class="col-md-4">
                <label>&nbsp;</label>
                <div class="form-group">
                    <?php echo Html::a('<span class="glyphicon glyphicon-remove"></span> Cancelar ', ['index'], ['class' => 'btn btn-danger']); ?>
                    <?php echo Html::submitButton(' <span class="glyphicon glyphicon-ok"></span> Generar ',['class' => 'btn btn-success']) ?>
                    <?php //echo Html::a('<span class="glyphicon glyphicon-file"></span> Reporte ', ['bloqueos-xls'], ['class' => 'btn btn-primary']); ?>
                </div>
            </div>
        </div>
    </div>
    
    <?php ActiveForm::end(); ?><!-- /.form -->

</div>


