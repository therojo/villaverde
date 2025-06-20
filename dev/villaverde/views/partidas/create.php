<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Partidas $model */

$this->title = 'Create Partidas';
$this->params['breadcrumbs'][] = ['label' => 'Partidas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="partidas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
