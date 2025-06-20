<?php
use yii\widgets\Breadcrumbs;
//use dmstr\widgets\Alert;

?>
<div class="content-wrapper">
    <section class="content-header">
        <?php if (isset($this->blocks['content-header'])) { ?>
            <h1><?= $this->blocks['content-header'] ?></h1>
        <?php } else { ?>
            <h1>
                <?php
                if ($this->title !== null) {
                    echo \yii\helpers\Html::encode($this->title);
                } else {
                    echo \yii\helpers\Inflector::camel2words(
                        \yii\helpers\Inflector::id2camel($this->context->module->id)
                    );
                    echo ($this->context->module->id !== \Yii::$app->id) ? '<small>Module</small>' : '';
                } ?>
            </h1>
        <?php } ?>

        <?=
        Breadcrumbs::widget(
            [
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]
        ) ?>
    </section>

    <section class="content">

        <?php foreach (Yii::$app->session->getAllFlashes() as $message):; ?>
        <?=

            \app\components\Alertas::widget([
             'type'=>$message['type'],
             'action'=>$message['action'],
             'body'=>$message['body']
            ]);

            /*
                 \kartik\widgets\Alert::widget([
                    'type' =>  $message['type'],
                    'icon' => $message['icon'],
                    'title' => $message['title'],
                    'body' => $message['body'],
                    'showSeparator' => true,
                    'delay' => 2000,
                 ]);
            */
        ?>
        <?php endforeach; ?>

        <?= $content ?>
    </section>
</div>

<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <!-- <b>Version</b> 2.0 -->
    </div>
    <strong>&copy; Derechos Reservados - <a href="http://www.villa.org.mx" target="_blank">Fraccionamiento Villa Verde , Zac., Zac.</a>.</strong>
</footer>

