<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use kartik\select2\Select2;
use yii\web\JsExpression;
use yii\helpers\Url;
use app\models\Colonos;

/* @var $this yii\web\View */
/* @var $inmueble app\inmuebles\Domicilios */
/* @var $form yii\widgets\ActiveForm */

$colono ="";

if(isset($model->idColono)){
    $modelColono = Colonos::findOne($model->idColono);
    $colono = $modelColono->nombre. " ".$modelColono->apellido1." ".$modelColono->apellido2;
}


?>

<div class="box box-success">
    <!-- form start -->
    <?php $form = ActiveForm::begin(); ?>

    <div class="box-body">

        <div class="row">   
            <div class="col-md-6">
                <label>Seleccione colono / vecino</label>
                <div class="form-group">
                    <?php echo $form->field($model, 'idColono')->widget(
                        Select2::classname(),
                        [
                            //'language' => 'es',
                            'initValueText' =>$colono,
                            // $producto, // set the initial display text
                            // 'disabled' => $estatusDisabled,
                            'options' => [
                                'placeholder' => 'Buscar colono',
                                'onchange' => 'populateCliente(this.value)'
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
                                    'data' => new JsExpression('function(params) { return {q:params.term}; }')

                                ],
                                'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                                'templateResult' => new JsExpression('function(registro) { return registro.text; }'),
                                'templateSelection' => new JsExpression('function (registro) { return registro.text; }'),
                            ],

                            /* 'pluginEvents' => [
                                'change' => 'function() {$.post("' . Yii::$app->urlManager->createUrl('inmueble-colonos/lista-ajax?idColono=') . '"+$(this).val(),
                                    function(data)
                                    {
                                        $("select#pagos-idinmueblecolono").html(data);
                                    }
                                ); }'
                            ] */

                        ]
                    )->label(false);
                    ?>
                </div>
            </div>
        </div>
        
        <div class="row">   
           <div class="col-md-6">
                <div class="form-group">
                    <?=
                    $form->field($model, 'idCalle')->widget(
                        Select2::classname(),
                        [
                            'language' => 'es',
                            'data' => $arrCalles,
                            'pluginOptions' => [
                                'placeholder' => 'Seleccione calle',
                                'allowClear' => true,
                            ],
                            'pluginEvents' => [
                                'change' => 'function() {$.post("' . Yii::$app->urlManager->createUrl('inmuebles/no-asignados-ajax?idCalle=') . '"+$(this).val(),
                                function(data)
                                {
                                    $("select#inmueblescolonos-idinmueble").html(data);
                                }
                        ); }'
                            ]
                        ]
                    );
                    ?>
                </div>
            </div>
        </div> <!-- /.row -->

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <?php echo $form->field($model, 'idInmueble')->widget(
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
        

    </div>
    <!-- /.box-body -->

    <div class="box-footer">
        <?php echo Html::a('<span class="glyphicon glyphicon-remove"></span> Cancelar ', ['index'], ['class' => 'btn btn-danger']); ?>
        <?php echo Html::submitButton($inmueble->isNewRecord ? ' <span class="glyphicon glyphicon-ok"></span> Crear' : '<span class="glyphicon glyphicon-ok"></span> Actualizar', ['class' => 'btn btn-success']) ?>
    </div>
    
    <?php ActiveForm::end(); ?><!-- /.form -->
</div>
<!-- /.box-success -->