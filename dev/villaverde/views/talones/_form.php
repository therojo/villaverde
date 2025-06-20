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
            <div class="col-md-2">
                <div class="form-group">
                    <i class="fa fa-book fa-4x"></i>
                </div>
            </div>

             <div class="col-md-4">
                <div class="form-group">
                    <p>
                        <h3>Talonario número <?=$model->numero?></h3>    
                    </p>
                </div>
            </div>
        </div>

        <!-- <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <h4>
                    <? // $form->field($model, 'numero')->textInput(
                        // [
                        //     'maxlength' => true,
                        //     'placeholder' => 'Número de talonario',
                        //     'autofocus' => true,
                        //     'disabled' =>'true'
                        // ]
                        // )->label('Número') ?>
                    </h4>
                </div>
            </div>
        </div>
            -->

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, 'folioInicial')->textInput(
                        [
                            'maxlength' => true,
                            'placeholder' => 'Ingrese folio inicial',
                            'autofocus' => true,
                        ]
                    )->label('Folio inicial') ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, 'folioFinal')->textInput(
                        [
                            'maxlength' => true,
                            'placeholder' => 'Ingrese folio final',
                            'autofocus' => true,
                        ]
                    )->label('Folio final') ?>
                </div>
            </div>

        </div> <!-- /.row --> 

        <div class="row">

            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, 'nombre')->textInput(
                        [
                            'maxlength' => true,
                            'placeholder' => 'Ingrese nombre o descripción',
                            'autofocus' => true,
                        ]
                    )?>
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