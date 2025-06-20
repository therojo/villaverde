<?php

use yii\helpers\Html;
// use yii\grid\GridView;
use kartik\grid\GridView;
use app\models\Usuarios;
use yii\widgets\ActiveForm;
use app\models\InmueblesColonos;
use app\models\Colonos;
use app\models\DetallePagosSearch;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PagosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

// $this->title = isset($contrato->id) ?'Contrato '.$contrato->folio." ( $". number_format($contrato->total, 2, '.', ',') ." )":"";

if (isset($inmuebleColono->id)) {
    $this->title = 'Pagos registrados para ' . $inmuebleColono->idInmueble0->idCalle0->nombre;
    $this->title.=" ". $inmuebleColono->idInmueble0->numero;
} else {
    $this->title = "Pagos";
}

$this->params['breadcrumbs'][] = ['label' => 'Colonos', 'url' => ['colonos/index']];
$this->params['breadcrumbs'][] = ['label' => 'Inmuebles', 'url' => ['inmueble-colonos/index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<?php
$gridColumns = [
    // ['class' => 'yii\grid\SerialColumn'],
    [
        'class' => 'kartik\grid\ExpandRowColumn',
        'value' => function ($model, $key, $index, $column) {
            return GridView::ROW_COLLAPSED;
        },
        'detail' => function ($model, $key, $index, $column) {
            $searchModel = new DetallePagosSearch();
            $searchModel->idPago = $model->id;
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return Yii::$app->controller->renderPartial(
                '_detallePagos',
                [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'colono' => $model
                ]
            );
        },
        'detailAnimationDuration' => 100,
        'expandIcon' => '<span class="fa fa-angle-right"></span>',
        'collapseIcon' => '<span class="fa fa-angle-down"></span>',
    ],
    [
        'attribute'=>'idColono',
        'value'=>function ($model) use ($colono) {
            return (new Colonos())->getFullName($model->idInmuebleColono0->idColono0->id);
        }
    ],    

    [
        'attribute'=>'fecha',
        'header'=>'Fecha Pago',
        'value'=>function ($model) {
            return $model->fecha;
        },
        'format'=>"date"
    ],
    [
        'attribute'=> 'idInmuebleColono',
        'header'=>'Inmueble',
        'value'=> function($model){
            return ($model->idInmuebleColono0->idInmueble0)->fullAddress();
        }
    ],
    
    /*[
        'attribute' => 'idMes',
        'value' => function ($model) {
            return $model->id; // idMes0->nombre;
        },
        'filterType' => GridView::FILTER_SELECT2,
        'filter' => $arrMeses,

        'filterWidgetOptions' => [
            'pluginOptions' => ['allowClear' => true],
        ],

        'filterInputOptions' => ['placeholder' => 'Seleccione...'],
        'hAlign' => GridView::ALIGN_CENTER,
    ],*/
    
    /*[
        'attribute' => 'idEjercicio',
        'value' => function ($model) {
            return $model->idEjercicio0->numero;
        },
        'filterType' => GridView::FILTER_SELECT2,
        'filter' => $arrEjercicios,

        'filterWidgetOptions' => [
            'pluginOptions' => ['allowClear' => true],
        ],

        'filterInputOptions' => ['placeholder' => 'Seleccione...'],
        'hAlign' => GridView::ALIGN_CENTER,
    ],*/
    
    [
        'attribute'=> 'folio',
        'value'=> function($model){
            return ucfirst($model->folio);
        },
        'hAlign' => GridView::ALIGN_CENTER,
    ],
    
    [
        'attribute' => 'idTalon',
        'value' => function ($model) {
            return $model->idTalon0->numero;
        },
        'hAlign' => GridView::ALIGN_CENTER,
    ],
    [
        'attribute'=> 'numeroMensualidades',
        'value'=> function($model){
            return ucfirst($model->numeroMensualidades);
        },
        'hAlign'=>GridView::ALIGN_CENTER
    ],
   
    /*[
        'attribute' => 'idUsuario',
        'value' => function ($model) {
            return $model->idUsuario0->idColono0->nombre;
        },
        'header' => 'Recibio'
    ],*/
    [
        'attribute'=> 'total',
        'value'=> function($model){
            return ucfirst($model->total);
        },
        'format' => 'currency',
        'hAlign' => GridView::ALIGN_RIGHT,
    ],
    
    /*[
        'attribute' => 'monto',
        'pageSummary' => true,
        'hAlign' => GridView::ALIGN_RIGHT,
        'value' => function ($model) {
            return $model->total;
        },
        'format' => 'currency',
    ],*/
    [
        //'class' => 'yii\grid\ActionColumn',
        'class' => 'kartik\grid\ActionColumn',
        'header' => Html::a(
            '<i class="glyphicon glyphicon-plus"></i> &nbsp;Nuevo',
            [
                'create',
                "idInmuebleColono"=>isset($inmuebleColono->id)? $inmuebleColono->id:0
            ]
        ),
        'template' => '{cancelar}',
        'buttons' => [
            'cancelar' => function ($url, $model, $key) {
                if (Yii::$app->session->get('tipo') == Usuarios::_ADMIN) {
                    return Html::a(
                        '<span class="glyphicon glyphicon-trash"></span>',
                        [
                            'pagos/cancelar',
                            'id' => $model->id,
                        ],
                        [
                            'title' => 'Cancelar',
                            'data-toggle' => 'tooltip',
                            'data-confirm' => '¿ Esta seguro de cancelar este pago  de '.$model->idInmuebleColono0->idColono0->nombre.' por $ '.$model->total.' ?'
                        ]
                    );
                }
            },
        ]
    ]
];
?>
<div class="row">
  <div class="col-xs-12">
    <div class="box box-success">
      <div class="box-body">
        <div class="pagos-index">
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                <?php echo GridView::widget(
                    [
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => $gridColumns,
                        'showPageSummary' => true,
                    ]
                );
                ?>
                </div>
            </div>
        <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
