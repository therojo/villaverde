<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ejercicios */

$this->title = 'Crear Ejercicio';
$this->params['breadcrumbs'][] = ['label' => 'Ejercicios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ejercicios-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
