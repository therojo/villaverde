<?php
use yii\helpers\Html;
use app\models\Contratos;
use kartik\grid\GridView;

use yii\widgets\ActiveForm;
use app\models\TipoServicios;

?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'showFooter' => true,
    'showPageSummary' => true,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        // 'id',
        [
            'attribute' => 'idInmueble',
            'value' => function ($model) {
                return ($model->idInmueble0)->fullAddress();
            }
        ],
        'fechaInicio:date',
        [
            'attribute'=> 'estatus',
            'value'=> function($model){
                return ucfirst($model->estatus);
            }
        ],
        
        [
            'attribute'=> 'alCorriente',
            'value'=> function($model){
                return ucfirst($model->alCorriente);
            }
        ]
    ],
]);