<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Egresos $model */

$this->title = 'Update Egresos: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Egresos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="egresos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
