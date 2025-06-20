<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Domicilios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="box box-success">
    <!-- form start -->
    <?php $form = ActiveForm::begin(); ?>

    <div class="box-body">
        <div class="row">
            <div class="col-md-1">
                <div class="form-group">
                    <i class="fa fa-home fa-4x"></i>
                </div>
            </div>
        </div>

        <div class="row">   
            <div class="col-md-8">
                <div class="form-group">
                    <?php echo $form->field($model, 'idCalle')->widget(
                        Select2::classname(),
                        [
                            'data' => $arrCalles,
                            'options' => ['placeholder' => 'Seleccione Calle'],
                            'pluginOptions' => ['allowClear' => true]
                        ]
                    )
                    ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <?php echo $form->field($model, 'numero')->textInput(['maxlength' => true, 'placeholder' => 'Ingrese Numero'])->label('Numero') ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <?php echo $form->field($model, 'numeroInterior')->textInput(['maxlength' => true, 'placeholder' => 'Ingrese numero Interior'])->label('Numero Interior') ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <?php echo $form->field($model, 'observaciones')->textInput(['maxlength' => true, 'placeholder' => 'Ingrese Observaciones'])->label('Observaciones') ?>
                </div>
            </div>
        </div>

    </div>
    <!-- /.box-body -->

    <div class="box-footer">
        <?php echo Html::a('<span class="glyphicon glyphicon-remove"></span> Cancelar ', ['index'], ['class' => 'btn btn-danger']); ?>
        <?php echo Html::submitButton($model->isNewRecord ? ' <span class="glyphicon glyphicon-ok"></span> Crear' : '<span class="glyphicon glyphicon-ok"></span> Actualizar', ['class' => 'btn btn-success']) ?>
    </div>
    
    <?php ActiveForm::end(); ?><!-- /.form -->
</div>
<!-- /.box-success -->

