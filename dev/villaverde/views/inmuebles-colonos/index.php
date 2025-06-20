<?php

use yii\helpers\Html;
    // use yii\grid\GridView;
use kartik\grid\GridView;
use kartik\export\ExportMenu;
use app\models\Colonos;
use app\models\Usuarios;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MovimientosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

if (isset($colono->id)) {
    $this->title = 'Inmueble(s) asociados a '.(new Colonos())->getFullName($colono->id);
} else {
    $this->title = 'Inmuebles de Colonos';
}

$this->params['breadcrumbs'][] = ['label' => 'Colonos', 'url' => ['colonos/index']];
$this->params['breadcrumbs'][] = ['label' => 'Inmuebles'];

if (isset($colono->id)) {
    // $this->params['breadcrumbs'][] = Colonos::getFullName($colono->id);
}

// $this->params['breadcrumbs'][] = $this->title;

?>

<?php
$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],
    //'id',
    [
        'attribute'=> 'nombreDelColono',
        'value'=> function($model){
            return $model->idColono0->getFullName($model->idColono);
        },
    ],
    [
        'attribute'=>'idCalle',
        'value'=>function ($model) {
            return $model->idInmueble0->idCalle0->nombre;
        },
        'filterType' => GridView::FILTER_SELECT2,
        'filter' => $arrCalles,

        'filterWidgetOptions' => [
            'pluginOptions' => ['allowClear' => true],
        ],

        'filterInputOptions' => ['placeholder' => 'Seleccione...'],
    ],
    [
        'attribute'=> 'numero',
        'value'=>function ($model) {
            return $model->idInmueble0->numero;
        },
    ],
    [
        'attribute'=> 'numeroInterior',
        'value'=>function ($model) {
            return $model->idInmueble0->numeroInterior;
        }
    ],
    'fechaInicio:date',
    
    [
        'attribute'=> 'alCorriente',
        'format'=>'html',
        'value'=>function ($model) {
            if($model->alCorriente =="si"){
                $etiqueta = '<h4><span class="label label-success">'.$model->alCorriente.'</span></h4>';
            } else {
                $etiqueta = '<h4><span class="label label-warning">'.$model->alCorriente.'</span></h4>';
            }

            return $etiqueta;
        },
        'filterType' => GridView::FILTER_SELECT2,
        'filter' => array(
            "si" => "Si",
            "no" => "No",
        ),

        'filterWidgetOptions' => [
            'pluginOptions' => ['allowClear' => true],
        ],
        'hAlign' => GridView::ALIGN_CENTER,

        'filterInputOptions' => ['placeholder' => 'Seleccione...'],
    ],
    [
        'class' => 'yii\grid\ActionColumn',
        'header' => Html::a(
            '<i class="glyphicon glyphicon-plus"></i> &nbsp;Nuevo',
            ['inmuebles-colonos/create','idColono'=>$colono->id?$colono->id:0]
        ),
        'template' => '{pagos}',
        'buttons' => [
            'pagos' => function ($url, $model, $key) {
                if (Yii::$app->session->get('tipo') == Usuarios::_ADMIN) {
                    return Html::a(
                        '<span class="glyphicon glyphicon-usd"></span>',
                        // "<i class='fas fa-hand-holding-usd'></i> ",
                        [
                            'pagos/index',
                            'idInmuebleColono' => $model->id,
                        ],
                        [
                            'title' => 'Ver pagos',
                            'data-toggle' => 'tooltip',
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
            <div class="inmuebles-index">
                <?php
                /* echo ExportMenu::widget(
                    [
                        'dataProvider' => $dataProvider,
                        'columns' => $gridColumns,
                        'columnSelectorOptions' => [
                            'label' => 'Columns',
                            'class' => 'btn btn-default'
                        ],
                        'fontAwesome' => true,
                        'dropdownOptions' => [
                            'label' => 'Exportar todo',
                            'class' => 'btn btn-success'
                        ],
                        'exportConfig' => [
                            ExportMenu::FORMAT_HTML => false,
                            ExportMenu::FORMAT_TEXT => false,
                        ],
                        'filename' => "movimientos" . date('Y-m-d'),
                        'showConfirmAlert' => false
                    ]
                ); */
                ?>

                <hr>
                <?php 
                    //echo Html::a('<span class="glyphicon glyphicon-print"></span> Reporte ', ['reporte'], ['class' => 'btn btn-success']);
                ?>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => $gridColumns,
                    'export' => [
                        'fontAwesome' => true,
                    ]
                ]);
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