<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Chips */

$this->title = 'Registrar Chip';
$this->params['breadcrumbs'][] = ['label' => 'Chips', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="chips-create">

    <?= $this->render('_form', [
        'model' => $model,
        'arrColonos' => $arrColonos,
        'arrInmueblesColono' =>[]
    ]) ?>

</div>
