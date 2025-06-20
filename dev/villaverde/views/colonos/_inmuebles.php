<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
//use yii\grid\GridView;
use kartik\grid\GridView;

?>

<?php
$gridColumns = [
    ['class' => 'kartik\grid\SerialColumn'],
    [
        'attribute' => 'idCalle',
        'value' => function ($model) {
            return $model->idInmueble0->numero;
        },
    ],
    [
        'attribute' => 'numero',
        'value' => function ($model) {
            return $model->idInmueble0->numero;
        },
    ],
    [
        'attribute' => 'numeroInterior',
        'value' => function ($model) {
            return $model->idInmueble0->numeroInerior;
        },
    ],
    [
        'attribute' => 'alCorriente',
        'value' => function ($model) {
            return ucfirst($model->alCorriente);
        },
    ],

    [
        'class' => 'kartik\grid\ActionColumn',
        'template' => '{eliminar}',
        'buttons' => [
            'eliminar' => function ($url, $model, $key) {
                return Html::a(
                    '<span class="glyphicon glyphicon-trash"></span>',
                    [
                        'prorrateos/eliminar',
                        'id' => $model->id,
                    ],
                    [
                        'title' => 'Eliminar',
                        'data-toggle' => 'tooltip'
                    ]
                );
            },
        ],
    ],
];
?>

<?php
echo GridView::widget(
    [
        'dataProvider' => $dataProviderInmueblesColonos,
            //'filterModel' => $searchModel,
        'columns' => $gridColumns,
        'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false

        'pjax' => true,
            //'bordered' => true,
            //'striped' => false,
        'condensed' => false,
        'responsive' => true,
        'hover' => true,
        'floatHeader' => true,
            //'floatHeaderOptions' => ['scrollingTop' => $scrollingTop],
        'showPageSummary' => true,
        'panel' => [
            'type' => GridView::TYPE_SUCCESS
        ],
    ]
);