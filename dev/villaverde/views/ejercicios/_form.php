<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Colonos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="box box-success">
    <!-- form start -->
    <?php $form = ActiveForm::begin(); ?>

    <div class="box-body">
        <div class="row">
            <div class="col-md-1">
                <div class="form-group">
                    <i class="fa fa-calendar-plus fa-4x"></i>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, 'numero')->textInput(
                        [
                            'maxlength' => true,
                            'placeholder' => 'Ingrese ejercicio',
                            'autofocus' => true,
                        ]
                    )->label('Ejercicio') ?>
                </div>
            </div>
        </div> <!-- /.row --> 
    </div>
    <!-- /.box-body -->

    <div class="box-footer">
        <?= Html::a('<span class="glyphicon glyphicon-remove"></span> Cancelar ', ['index'], ['class' => 'btn btn-danger']); ?>
        <?= Html::submitButton($model->isNewRecord ? ' <span class="glyphicon glyphicon-ok"></span> Crear' : '<span class="glyphicon glyphicon-ok"></span> Actualizar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <!-- /.form -->
</div>
<!-- /.box -->