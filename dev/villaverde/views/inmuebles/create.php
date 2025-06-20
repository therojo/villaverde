<?php

use yii\helpers\Html;
use app\models\Colonos;

/* @var $this yii\web\View */
/* @var $model app\models\Inmuebles */

$this->title = 'Crear Inmueble';
$this->params['breadcrumbs'][] = [
    'label' => 'Inmuebles',
    'url' => ['index']
];
$this->params['breadcrumbs'][] = "Crear";
?>
<div class="inmuebles-create">

    <?= $this->render(
        '_form', 
        [
            'model' => $model,
            'arrCalles' => $arrCalles,
        ]
    ) ?>

</div>
