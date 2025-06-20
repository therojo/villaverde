<?php

use app\models\DetallePagos;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\DetallePagosSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Pagos';
$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'][] = ['label' => 'Nuevo', 'url' => ['pagos/create']];
?>
<div class="detalle-pagos-index">

    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'idColono',
            'fecha',
            'monto',
            'idMes',
            'idEjercicio',
            'idInmueble',
            'folio',
            'idTalon',
            'total',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, DetallePagos $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
