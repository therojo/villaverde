<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Partidas $model */

$this->title = 'Update Partidas: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Partidas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="partidas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
