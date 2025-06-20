<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\DetallePagos $model */

$this->title = 'Create Detalle Pagos';
$this->params['breadcrumbs'][] = ['label' => 'Detalle Pagos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="detalle-pagos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
