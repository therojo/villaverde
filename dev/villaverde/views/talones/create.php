<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Talones */

$this->title = 'Crear talon';
$this->params['breadcrumbs'][] = ['label' => 'Talones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="talones-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
