<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Chips */

$this->title = 'Actualizar Chip ' . $model->numero;
$this->params['breadcrumbs'][] = ['label' => 'Chips', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="chips-update">
    <?= $this->render('_form', [
        'model' => $model,
        'arrColonos' => $arrColonos,
        'arrInmueblesColono' =>$arrInmueblesColono
    ]) ?>

</div>
