<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">' . \kartik\helpers\Html::icon('education') . '</span><span class="logo-lg">' . \kartik\helpers\Html::icon('education') . '&nbsp;' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>
    
    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            <?php
                echo Yii::$app->session->get('ejercicio');
            ?>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <!-- Messages: style can be found in dropdown.less-->
                <!-- User Account: style can be found in dropdown.less -->
                <li class="user user-menu">
                    <?php $usuario = (Yii::$app->session['nombreUsuario']) ? '( ' . Yii::$app->session['nombreUsuario'] . ' )' : '' ; ?>
                    <?= Html::a('Salir ' . $usuario . '&nbsp; <span class="hidden-xs glyphicon glyphicon-log-out"></span>', ['/site/logout'], ['data-method' => 'post', 'class' => 'btn-fla']) ?>
                </li>

            </ul>

        </div>
    </nav>
</header>
