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
            'attribute'=> 'idEjercicio',
            'value'=> function($model){
                return $model->idEjercicio0->numero;
            }
        ],
        [
            'attribute' => 'idMes',
            'value' => function ($model) {
                return ($model->idMes0)->texto($model->idMes);
            }
        ],
        'observaciones',
        [
            'attribute'=> 'estatus',
            'value'=> function($model){
                return ucfirst($model->estatus);
            }
        ],
        [
            'attribute'=> 'monto',
            'value'=> function($model){
                return ucfirst($model->monto);
            },
            'format' => 'currency',
            'hAlign' => GridView::ALIGN_RIGHT,
        ]
        
    ],
]);