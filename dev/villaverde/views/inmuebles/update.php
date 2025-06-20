<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Inmuebles */

$this->title = 'Actualizar inmueble: ';
$this->params['breadcrumbs'][] = ['label' => 'Inmuebles', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Actualizar';

?>
<div class="inmuebles-update">

    <?= $this->render('_form', [
        'model' => $model,
        'arrCalles' => $arrCalles,
    ]) ?>

</div>
