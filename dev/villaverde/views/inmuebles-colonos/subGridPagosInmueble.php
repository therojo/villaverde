<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;

?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'showFooter' => true,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        //'id',
        'fecha',
        'folio',
        [
            'attribute'=>'idEjercicio',
            'value'=>function ($model) {
                return $model->idEjercicio0->numero;
            }
        ],
        [
            'attribute'=>'idMes',
            'value'=>function ($model) {
                return $model->idMes0->nombre;
            }
        ],
        [
            'attribute'=>'idTalon',
            'value'=>function ($model) {
                return $model->idTalon0->numero;
            }
        ],

        'monto:currency',
        [
            'attribute'=>'idUsuario',
            'value'=>function ($model) {
                return $model->idUsuario0->idColono0->nombre;
            }
        ],
    ],
]);
