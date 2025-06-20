<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

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
                    <i class="fa fa-user fa-4x"></i>
                </div>
            </div>
        </div>

        <div class="row">   
            <div class="col-md-4">
                <div class="form-group">
                    <?php echo $form->field($model, 'idColono')->widget(
                        Select2::classname(),
                        [
                            'data' => $arrColonos,
                            'options' => ['placeholder' => 'Seleccione Colono'],
                            'pluginOptions' => ['allowClear' => true]
                        ]
                    )
                    ?>
                </div>
            </div>
        </div> <!-- /.row -->

        <!-- <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <?php /*$form->field($colono, 'nombre')->textInput(
                        [
                            'maxlength' => true,
                            'placeholder' => 'Colono',
                            'autofocus' => true,
                            'disabled'=>true
                        ]
                    )->label('Colono')  */
                    ?>
                </div>
            </div>
        </div> --> 

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, 'username')->textInput(
                        [
                            'maxlength' => true,
                            'placeholder' => 'Ingrese cuenta o nombre de usuario',
                            'autofocus' => true,
                        ]
                    )->label('Cuenta deseada para ingresar al sistema') ?>
                </div>
            </div>
        </div> <!-- /.row --> 

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, 'password')->textInput(['maxlength' => true, 'placeholder' => 'Ingrese nombre', 'autofocus' => true])->label('Password') ?>
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
