<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pagos */

$this->title = 'Registro de pagos';
$this->params['breadcrumbs'][] = ['label' => 'Pagos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pagos-create">

    <?= $this->render('_form', [
        'model' => $model,
        'arrColonos' => $arrColonos,
        'colono' => $colono,
        'arrTalones' => $arrTalones,
        'talonActivo' =>$talonActivo,
        'siguienteFolio' =>$siguienteFolio,
        'arrInmuebles' => $arrInmuebles,
        'arrMeses' => $arrMeses,
    ]) ?>

</div>
