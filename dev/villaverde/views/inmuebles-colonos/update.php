<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\InmueblesColonos */

$this->title = 'Update Inmueble Colonos: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Inmueble Colonos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="inmueble-colonos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
