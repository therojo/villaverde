<?php

use app\models\InmueblesColonosSearch;
use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use kartik\export\ExportMenu;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ColonosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Colonos';
$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'][] = ['label' => 'Nuevo', 'url' => ['create']];
?>
<div class="colonos-index">
    <?php
    $gridColumns = [
        // ['class' => 'yii\grid\SerialColumn'],
        //'id',
        [
            'class' => 'kartik\grid\ExpandRowColumn',
            'value' => function ($model, $key, $index, $column) {
                return GridView::ROW_COLLAPSED;
            },
            'detail' => function ($model, $key, $index, $column) {
                $searchModel = new InmueblesColonosSearch();
                $searchModel->idColono = $model->id;
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                return Yii::$app->controller->renderPartial(
                    '_detalleInmueblesColonos',
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
        'nombre',
        'apellido1',
        'apellido2',
        'telefono',
        'email:email',
        //'fechaRegistro:date',
        // 'fechaSalida:date',
        [
            'attribute'=> 'estatus',
            'value'=>function ($model) {
                return ucfirst($model->estatus);
            }
        ],

        [
            'class' => 'yii\grid\ActionColumn',
            'header' => Html::a(
                '<i class="glyphicon glyphicon-plus"></i> &nbsp;Nuevo',
                ['create']
            ),
            'template' => '{update}{inmuebles}{chips}{crearUsuario}',
            'buttons' => [
                'update' => function ($url, $model, $key) {
                    return Html::a(
                        '<span class="glyphicon glyphicon-pencil"></span>',
                        [
                            'colonos/update',
                            'id' => $model->id,
                        ],
                        [
                            'title' => 'Actualizar',
                            'data-toggle' => 'tooltip'
                        ]
                    );
                },
                'inmuebles' => function ($url, $model, $key) {
                    return Html::a(
                        '<span class="glyphicon glyphicon-home"></span> ',
                        [
                            'inmuebles-colonos/index',
                            'idColono' => $model->id,
                        ],
                        [
                            'title' => 'Inmuebles',
                            'data-toggle' => 'tooltip'
                        ]
                    );
                },
                'chips' => function ($url, $model, $key) {
                    return Html::a(
                        " <i class='fas fa-car'></i>",
                        [
                            'chips/index',
                            'idColono' => $model->id,
                        ],
                        [
                            'title' => 'Chips',
                            'data-toggle' => 'tooltip'
                        ]
                    );
                },
                'crearUsuario' => function ($url, $model, $key) {
                    return Html::a(
                        " <i class='fas fa-key'></i>",
                        [
                            'usuarios/create',
                            'idColono' => $model->id,
                        ],
                        [
                            'title' => 'Crear usuario',
                            'data-toggle' => 'tooltip'
                        ]
                    );
                },
            ],
        ],
    ];
        
    ?>

<div class="row">
  <div class="col-xs-12">
    <div class="box box-success">
      <div class="box-body">
            <div class="entradas-index">
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
                        'filename' => "almacen_" . date('Y-m-d'),
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
