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
                    <i class="fa fa-dollar-sign fa-4x"></i>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                    <div class="form-group">
                        <?= $form->field($model, 'fecha')->widget(
                            DatePicker::classname(),
                            [
                                'options' => [
                                    'placeholder' => 'Seleccione fecha de pago',
                                    'readonly' => false,
                                ],
                                'pluginOptions' => [
                                    'autoclose' => true,
                                    'todayHighlight' => true,
                                    'format' => 'yyyy-mm-dd',
                                ],
                                'pluginEvents' => []
                            ]
                        )->label('Fecha de pago');
                        ?>
                    </div>
            </div><!-- /col -->
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <?php echo $form->field($model, 'total')->textInput(['maxlength' => true, 'placeholder' => 'Ingrese Numero'])->label('Importe') ?>
                </div>
            </div>
        </div>

        <div class="row">   
            <div class="col-md-4">
                <div class="form-group">
                    <?php echo $form->field($model, 'idPartida')->widget(
                        Select2::classname(),
                        [
                            'data' => $listaPartidas,
                            'options' => ['placeholder' => 'Seleccione Partida'],
                            'pluginOptions' => ['allowClear' => true]
                        ]
                    )
                    ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <?php echo $form->field($model, 'descripcion')->textInput(['maxlength' => true, 'placeholder' => 'Ingrese Numero'])->label('Descripción del pago') ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="box-footer text-center">
                    <?php echo Html::a('<span class="glyphicon glyphicon-remove"></span> Cancelar ', ['index'], ['class' => 'btn btn-danger']); ?>
                    <?php echo Html::submitButton($model->isNewRecord ? ' <span class="glyphicon glyphicon-ok"></span> Registrar' : '<span class="glyphicon glyphicon-ok"></span> Actualizar', ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>
    </div>
    
    <?php ActiveForm::end(); ?><!-- /.form -->

</div>

