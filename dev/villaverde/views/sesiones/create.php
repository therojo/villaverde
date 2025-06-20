<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Sesiones $model */

$this->title = 'Create Sesiones';
$this->params['breadcrumbs'][] = ['label' => 'Sesiones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sesiones-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
