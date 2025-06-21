<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\web\JsExpression;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */
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
           <div class="col-md-6">
               <div class="form-group">
                  <label class="control-label" for="chips-idColono">Buscar Colono</label>
                        <?php echo $form->field($model, 'idColono')->widget(
                            Select2::classname(),
                            [
                                //'language' => 'es',
                                'initValueText' => "", // isset($model->id) ? $model->idContribuyente0->razonSocial : "",  // set the initial display text
                                // 'disabled' => $estatusDisabled,
                                'id' => 'lista-colono',
                                // 'data' => (!$modelPersona->isNewRecord)  ? [$modelPersona->id => $modelPersona->curp]: [],
                                'options' => [
                                    'placeholder' => 'Buscar Colono',
                                    // 'onchange' => 'mostrarBeneficiarios(this,"'.$urlAjax.'","'.$token.'")'
                                ],

                                'pluginOptions' => [
                                    'allowClear' => true,
                                    'minimumInputLength' => 4,
                                    'language' => [
                                        'errorLoading' => new JsExpression("function () { return 'Esperando resultados...'; }"),
                                    ],
                                    'ajax' => [
                                        'url' => Url::to(['colonos/listar']),
                                        'dataType' => 'json',
                                        'data' => new JsExpression('function(params) {return {q:params.term}; }')

                                    ],
                                    'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                                    'templateResult' => new JsExpression('function(registro) { return registro.text; }'),
                                    'templateSelection' => new JsExpression(
                                        'function (registro)
                                        { 
                                            if(registro.text === undefined){
                                                return "";
                                            } else {
                                                // document.getElementById("contribuyentes-rfc").value="";
                                                
                                                $("select#chips-idinmueblecolono").html(registro.data);

                                                return registro.text;                                                     
                                            }
                                        }'
                                    ),
                                ],
                            ]
                        )->label(false);
                        ?>
                    </div>
                </div>

                </div>


               </div>
           </div>
        </div>

         <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <?php echo $form->field($model, 'idInmuebleColono')->widget(
                        Select2::classname(),
                        [
                            'data' => [],
                            'options' => ['placeholder' => 'Seleccione inmueble'],
                            'pluginOptions' => ['allowClear' => true]
                        ]
                    )
                    ?>
                </div>
            </div>
        </div> <!-- /.row -->
        
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <?= $form->field($model, 'numero')->textInput(['maxlength' => true, 'placeholder' => 'Ingrese numero de chip', 'autofocus' => true])->label('Numero de chip') ?>
                </div>
            </div>
        </div> <!-- ./row -->  

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <?= $form->field($model, 'observaciones')->textInput(['maxlength' => true, 'placeholder' => 'Ingrese observaciones', 'autofocus' => true])->label('Observaciones') ?>
                </div>
            </div>
        </div> <!-- ./row --> 

    </div> <!-- /.box-body -->

    <div class="box-footer">
        <?= Html::a('<span class="glyphicon glyphicon-remove"></span> Cancelar ', ['index'], ['class' => 'btn btn-danger']); ?>
        <?= Html::submitButton($model->isNewRecord ? ' <span class="glyphicon glyphicon-floppy-disk"></span> Crear' : '<span class="glyphicon glyphicon-ok"></span> Actualizar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

 <!-- /.form -->

</div><!-- /.box -->
