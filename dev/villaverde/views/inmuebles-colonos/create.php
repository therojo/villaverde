<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\InmueblesColonos */

$this->title = 'Asociar inmueble a colono';
$this->params['breadcrumbs'][] = [
    'label' => 'Inmuebles de colono',
    'url' => ['index','idColono'=>$idColono]
];

$this->params['breadcrumbs'][] = $this->title;

?>
<div class="inmueble-colonos-create">

    <?= $this->render(
        '_form',
        [
            'model' => $model,
            'arrColonos' => $arrColonos,
            'inmueble' => $inmueble,
            'arrCalles' => $arrCalles,
            'idColono' => $idColono,
        ]
    ) ?>

</div>
