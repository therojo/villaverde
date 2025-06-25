<?php

use kartik\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'Administración Villa Verde 2025';

?>
<div class="site-index">

    <div class="jumbotron">
        
        <!-- <h1>Congratulations!</h1> -->
        
        <p class="lead">Seleccione una opcion del menu izquierdo o inferior</p>
        

        <p>
            <?= Html::a(
                '<span class="fa fa-users"> Colonos</span> ',
                ['colonos/index'],
                ['class' => 'btn btn-primary']
            ) ?> 

            <?= Html::a(
                '<span class="fa fa-dollar-sign"> Cuotas</span> ',
                ['pagos/index'],
                ['class' => 'btn btn-success']
            ) ?> 

             <?= Html::a(
                '<span class="fa fa-car"> Chips </span> ',
                ['chips/index'],
                ['class' => 'btn btn-primary']
            ) ?>
        </p>
        
    </div>

    <div class="body-content">

        <div class="row">
            <!-- <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div> -->
        </div>

    </div>
</div>
