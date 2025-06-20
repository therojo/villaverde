<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Bienvenidos';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-user form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
?>


    <div class="login-container-ltr">
        <div class="login-wrapper-ltr">
            <?php // Html::img('@web/images/historia.jpg', ['id' => 'background_image']); ?>
            <div class="login-box-footer-ltr">
                    &copy; Derechos Reservados 2020 - <a href="http://www.sazacatecas.gob.mx" target="_blank">Fraccionamiento Villa Verde</a>
            </div>
        </div>

        <div class="login-box-ltr">

                    <div class="login-logo-ltr text-center">
                        <?= Html::img(
                                // '@web/images/sa_logo_341x59.png',
                                '@web/images/villa_logo_verde.png',
                                [
                                    'height' =>'130px',
                                    'weight' =>'130px'
                                ]
                            );
                        ?>                        
                    </div>

                    <div class="login-title-ltr text-center">
                        <p class="text-muted">
                            <b>
                                <?php echo "Administración" ?> 
                                 <!-- Yii::$app->name -->
                            </b>
                        </p>
                    </div> 
                    
                    <!-- /.login-logo -->

                    <div class="login-box-msg-ltr">
                        <p class="text-muted">Inicie sesión con su cuenta que tiene asignada.</p>
                    </div>

                    <div class="login-box-body-ltr">

                        <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>

                        <?= $form
                            ->field($model, 'username', $fieldOptions1)
                            // ->label(false)
                            ->textInput(['placeholder' => 'Ingresar usuario', 'autofocus' => true]) ?>

                        <?= $form
                            ->field($model, 'password', $fieldOptions2)
                            // ->label(false)
                            ->passwordInput(['placeholder' => 'Ingresar contraseña']) ?>

                        <div class="row">
                            <div class="col-xs-4">
                                <?= Html::submitButton('Ingresar', ['class' => 'btn btn-danger btn-block btn-flat', 'name' => 'login-button']) ?>
                            </div>
                            <!-- /.col -->
                            <div class="col-xs-8">
                            </div>
                            <!-- /.col -->
                        </div>


                        <?php ActiveForm::end(); ?>

                    </div>
                    <!-- /.login-box-body.ltr -->

                    <div class="login-box-msg-ltr">
                        <p class="text-muted"> VillaVerde <b>2025</b> Mas Info.</p>
                    </div>

        </div>
    </div>
