<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */

$this->title = 'Crear Usuario';
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuarios-create">


    <?= $this->render('_form', [
        'model' => $model,
        'colono' => $colono,
        'arrColonos' => $arrColonos,
    ]) ?>

</div>
