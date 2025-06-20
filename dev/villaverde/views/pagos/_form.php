<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use yii\web\JsExpression;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Colonos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="box box-success">
    <!-- form start -->
    <?php $form = ActiveForm::begin(); ?>

    <div class="box-body">
       <!--  <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <i class="fas fa-hand-holding-usd fa-4x">
                        <?php
                             // echo Yii::$app->session->get('ejercicio');
                        ?>
                    </i>
                </div>
            </div>
        </div> -->

         <div class="row">
            <div class="col-md-5">
                &nbsp;
            </div>
            
            <div class="col-md-3 text-right">
                <div class="form-group">
                    
                    <div class="info-box mb-2">
                        <div class="info-box-content bg-green">
                            <span class="info-box-text"><h3>Block: # <?php echo $talonActivo->numero ?></h3></span>
                            
                        </div>
                        <?php 
                                if($model->folio == 0){
                                    ?>
                                     <p class="bg-danger text-white">Bloque sin talones disponibles, seleccione otro</p>
                                    <?php
                                }
                            ?>
                    </div>

                    <?php //$form->field($model, 'idTalon')->textInput(
                       // [
                       //     'maxlength' => true,
                       //     'placeholder' => 'Talon en uso',
                       //     'autofocus' => true,
                       //     'style'=>"color:black; font-weight:bold; font-size:x-large;"
                       // ]
                       // ) 
                    ?>                    
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
                                    'format' => 'dd-mm-yyyy',
                                ],
                                'pluginEvents' => []
                            ]
                        )->label('Fecha de pago');
                        ?>
                    </div>
            </div><!-- /col -->

            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, 'folio')->textInput(
                        [
                            'maxlength' => true,
                            'placeholder' => 'Número de recibo o folio',
                            'autofocus' => true,
                            'style'=>"background-color:#84ca6c; color:black; font-weight:bold; font-size:x-large; text-align:right;",
                            'disabled'=>true

                        ]
                    )->label('Número de recibo o folio') ?>
                </div>
            </div>
            
        </div>

        

         <div class="row">
            
            
            <div class="col-md-4">
                <div class="form-group">
                    <?php 
                        if (isset($colono->id)) {
                            echo $form->field($model, 'idColono')->widget(Select2::classname(), [
                                'data' => $arrColonos,
                                //'options' => ['placeholder' => 'Seleccione colono'],
                                'pluginOptions' => [
                                    'allowClear' => true,
                                    'disabled'=>true
                                    ]
                                    ]);
                                } else {
                                    ?>
                                        <label class="control-label" for="pagos-idColono">Colono</label>
                                    <?php
                                    echo $form->field($model, 'idColono')->widget(
                                        Select2::classname(),
                                        [
                                            'data'=>$arrColonos,
                                            //'language' => 'es',
                                            //'initValueText' => $colono ? $colono->nombre : "",
                                            // $producto, // set the initial display text
                                            // 'disabled' => $estatusDisabled,
                                            'pluginOptions' => [
                                                'placeholder' => 'Buscar colono',
                                                'onchange' => 'populateCliente(this.value)'
                                            ],
                                            'pluginEvents' => [
                                                    'change' => 'function() {$.post("' . Yii::$app->urlManager->createUrl('inmuebles-colonos/lista-ajax?idColono=') . '"+$(this).val(),
                                                    function(data) {
                                                        
                                                        $("select#pagos-idmes").empty();    
                                                        $("select#pagos-idinmueblecolono").html(data);
                                                    }
                                                ); }'
                                            ],
                                            /*'pluginOptions' => [
                                                'allowClear' => true,
                                                'minimumInputLength' => 3,
                                                'language' => [
                                                    'errorLoading' => new JsExpression("function () { return 'Esperando resultados...'; }"),
                                                ],
                                                'ajax' => [
                                                    'url' => Url::to(['colonos/listar']),
                                                    'dataType' => 'json',
                                                    'data' => new JsExpression('function(params) { return {q:params.term}; }')

                                                ],
                                                'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                                                'templateResult' => new JsExpression('function(nombre) { return nombre.text; }'),
                                                'templateSelection' => new JsExpression('function (nombre) { return nombre.text; }'),
                                            ],*/

                                        ]
                                    )->label(false);
                                }
                        ?>
                </div>
            </div>
       
            <div class="col-md-4">
                <div class="form-group">
                    <?=
                    $form->field($model, 'idInmuebleColono')->widget(Select2::classname(), [
                        'data' => $arrInmuebles,  // [],
                        'options' => isset($colono->id)?[]:['placeholder' => 'Seleccione inmueble'],
                        'pluginEvents' => [
                                //'change' => 'function() {$.post("' . Yii::$app->urlManager->createUrl('pagos/meses-por-pagar?idInmuebleColono=') . '"+$(this).val(),
                                'change' => 'function() {$.post("' . Yii::$app->urlManager->createUrl('pagos/ultimo-pago?idInmuebleColono=') . '"+$(this).val(),
                                function(data)
                                {
                                    
                                    $("#ultimoPago").text("");    
                                    $("#ultimoPago").text(data);    
                                    // $("select#pagos-idmes").empty();
                                    // $("select#pagos-idmes").html(data);
                                }
                        ); }'
                        ],
                        'disabled'=> isset($colono->id)?true:false
                    ])
                    ?>
                </div>
            </div>

            
            
            
        </div> <!-- /.row --> 

        <div class="row">
            
            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, 'numeroMensualidades')->textInput(
                        [   
                            'maxlength' => true,
                            'placeholder' => 'Numero de mensualidades pagadas',
                            'autofocus' => true,
                        ]
                    )->label('Número Mensualidades que paga') ?>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($model, 'total')->textInput(
                        [
                            'maxlength' => true,
                            'placeholder' => 'Ingrese total recibido',
                            'autofocus' => true,
                            'style'=>"background-color:#84ca6c; color:black; font-weight:bold; font-size:x-large;"
                        ]
                    )->label('Total Recibido $') ?>
                </div>
            </div>


        </div>
        
        <div class="row text-center">
            <div class="col-md-8">
                <div class="form-group">

                    <div class="info-box mb-3">
                        <span class="info-box-icon"><i class="fas fa-dollar-sign"></i></span>

                        <div class="info-box-content bg-success">
                            <span class="info-box-text"><h2>Ultimo Pago Registrado</h2></span>
                            <span class="info-box-number">
                            <p> <h2 id='ultimoPago' id='ultimoPago'></h2></p>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                </div>
            </div>

            <!--<div class="col-md-4">
                <div class="form-group">
                    <?php
                        //  $form->field($model, 'idMes')->widget(Select2::classname(), [
                        //     'data' => $arrMeses,
                        //     'options' => ['placeholder' => 'Seleccione mes a pagar'],
                        //     'pluginOptions' => [
                        //         'allowClear' => true,
                        //     ]
                        // ])->label('Meses que puede pagar (informativo)')
                    ?>
                </div>
            </div>    -->        

        </div> <!-- /.row --> 

        <div class="row">
            
            <div class="col-md-8">
                <div class="form-group">
                    <?= $form->field($model, 'observaciones')->textInput(['maxlength' => true, 'placeholder' => 'Ingrese observaciones si es necesario', 'autofocus' => true])->label('Observaciones') ?>
                </div>
            </div>
        </div> <!-- /.row -->

    </div>
    <!-- /.box-body -->

    <div class="box-footer text-center">
        <?= Html::a('<span class="glyphicon glyphicon-remove"></span> Cancelar ', ['index'], ['class' => 'btn btn-danger']); ?>
        <?php
            if($model->folio > 0) {
                echo Html::submitButton($model->isNewRecord ? ' <span class="glyphicon glyphicon-usd"></span> Registrar Pago' : '<span class="glyphicon glyphicon-ok"></span> Actualizar', ['class' => 'btn btn-success']);
            } else {
                echo Html::submitButton($model->isNewRecord ? ' <span class="glyphicon glyphicon-usd"></span> Registrar Pago' : '<span class="glyphicon glyphicon-ok"></span> Actualizar', ['class' => 'btn btn-success','disabled' => true]);
            }
        ?>
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