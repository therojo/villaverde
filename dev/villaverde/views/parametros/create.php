<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Parametros $model */

$this->title = 'Create Parametros';
$this->params['breadcrumbs'][] = ['label' => 'Parametros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parametros-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
