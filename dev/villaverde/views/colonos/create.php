<?php

use yii\helpers\Html;

/* @var $this yii\welb\View */
/* @var $model app\models\Colonos */

$this->title = 'Registrar Colono';
$this->params['breadcrumbs'][] = ['label' => 'Colonos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="colonos-create">
    <?= $this->render(
        '_form',
        [
            'model' => $model,
        ]
    )
    ?>

</div>
