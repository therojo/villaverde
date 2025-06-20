<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Colonos */

$this->title = 'Actualizar  datos de Colono';
$this->params['breadcrumbs'][] = ['label' => 'Colonos', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="colonos-update">

    <?= $this->render(
        '_form', 
        [
            'model' => $model,
        ]
    ) 
    ?>

</div>
