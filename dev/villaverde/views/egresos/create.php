<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Egresos $model */

$this->title = 'Registrar Egresos';
$this->params['breadcrumbs'][] = ['label' => 'Egresos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="egresos-create">

    <?= $this->render('_form', [
        'model' => $model,
        'listaPartidas'=>$listaPartidas
    ]) ?>

</div>
