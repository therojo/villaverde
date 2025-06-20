<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Talones */

$this->title = 'Actualizar';
$this->params['breadcrumbs'][] = ['label' => 'Talones', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->numero];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="talones-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
