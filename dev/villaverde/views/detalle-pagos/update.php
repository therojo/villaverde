<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\DetallePagos $model */

$this->title = 'Update Detalle Pagos: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Detalle Pagos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="detalle-pagos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
