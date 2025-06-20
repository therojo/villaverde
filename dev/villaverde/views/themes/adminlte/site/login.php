<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Bienvenidos!';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-user form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
?>

    <div class="container login-container">

        <div class="row">
          <div class="col-md-12 text-center"><?= Html::img('@web/images/logoSAD_2.png'); ?></div>
        </div>

        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10 text-center"><?= Html::img('@web/images/t-section-post.png'); ?></div>
            <div class="col-md-1"></div>
        </div>

        <div class="row">
            <div class="col-md-12">

                <div class="login-box">
                    <div class="login-logo">
                        <p class="text-muted"><b><?= Yii::$app->name ?></b></p>
                    </div>
                    <!-- /.login-logo -->
                    <div class="login-box-body">
                        <p class="login-box-msg">&nbsp;</p>

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
                            <div class="col-xs-8">
                            </div>
                            <!-- /.col -->
                            <div class="col-xs-4">
                                <?= Html::submitButton('Ingresar', ['class' => 'btn btn-success btn-block btn-flat', 'name' => 'login-button']) ?>
                            </div>
                            <!-- /.col -->
                        </div>


                        <?php ActiveForm::end(); ?>

                    </div>
                    <!-- /.login-box-body -->
                </div><!-- /.login-box -->

            </div>
        </div>


        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10 text-center"><?= Html::img('@web/images/t-section-shadow.png'); ?></div>
            <div class="col-md-1"></div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <p class="text-muted">Para acceder a la aplicación, ingrese su <b>usuario</b> y la <b>contraseña</b> que tiene asignada.</p>
                <p class="text-muted">Si tiene algún problema o comentario, comunicate con la <b>Mesa de ayuda</b> en la extensión 81 15123 para levantar tu reporte.</p>
                <p><strong>&copy; Derechos Reservados - Secretar&iacute;a de Administraci&oacute;n del Estado de Zacatecas.</strong></p>
            </div>
        </div>
  </div>
