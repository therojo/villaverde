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
                    <?= $form->field($model, 'nombre')->textInput(
                        [
                            'maxlength' => true,
                            'placeholder' => 'Ingrese nombre',
                            'autofocus' => true,
                            ]
                    )->label('Nombre') ?>
                </div>
            </div>
        </div> <!-- /.row --> 

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, 'apellido1')->textInput(['maxlength' => true, 'placeholder' => 'Ingrese nombre', 'autofocus' => true])->label('Primer apellido') ?>
                </div>
            </div>
        </div> <!-- /.row -->

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, 'apellido2')->textInput(['maxlength' => true, 'placeholder' => 'Ingrese nombre', 'autofocus' => true])->label('Segundo apellido') ?>
                </div>
            </div>
        </div> <!-- /.row -->

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, 'telefono')->textInput(['maxlength' => true, 'placeholder' => 'Ingrese nombre', 'autofocus' => true])->label('Telefono') ?>
                </div>
            </div>
        </div> <!-- /.row -->
        
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'placeholder' => 'Ingrese nombre', 'autofocus' => true])->label('Email') ?>
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

<?php

    /* echo Yii::$app->controller->renderPartial(
        '_inmuebles',
        array(
            // 'idServicio' => $servicio->id,
            'dataProviderInmueblesColonos' => $dataProviderInmueblesColonos,
        )
    ); */