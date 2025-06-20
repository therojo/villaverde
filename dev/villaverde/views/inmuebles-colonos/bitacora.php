<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use app\models\Colonos;
use app\models\Usuarios;
use kartik\grid\GridView;
use app\models\PagosSearch;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ClientesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$domicilio= "Bitacora de ".$model->idCalle0->nombre." ".$model->numero;
if ($model->numeroInterior) {
    $domicilio.=" interior ".$model->numeroInterior;
}

$this->title =$domicilio;
$this->params['breadcrumbs'][] = ['label' => 'Inmuebles', 'url' => ['inmuebles/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
  <div class="col-xs-12">
    <div class="box box-success">
      <div class="box-body">
        <div class="inmueble-colonos-index">

            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    //['class' => 'yii\grid\SerialColumn'],
                    [
                        'class' => 'kartik\grid\ExpandRowColumn',
                        'enableRowClick' => true,
                        'value' => function ($model, $key, $index, $column) {
                            return GridView::ROW_COLLAPSED;
                        },
                        'detail' => function ($model, $key, $index, $column) {
                            $searchModel = new PagosSearch();
                            $searchModel->idInmuebleColono = $model->id;
                            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                            return Yii::$app->controller->renderPartial(
                                'subGridPagosInmueble',
                                [
                                    'searchModel' => $searchModel,
                                    'dataProvider' => $dataProvider
                                ]
                            );
                        },
                        'detailAnimationDuration' => 100,
                        'expandIcon' => '<span class="fa fa-angle-right"></span>',
                        'collapseIcon' => '<span class="fa fa-angle-down"></span>',
                    ],
                    [
                        'attribute'=>'idCalle',
                        'value'=>function ($model) {
                            return $model->idInmueble0->idCalle0->nombre;
                        }
                    ],
                    [
                        'attribute'=>'numero',
                        'value'=>function ($model) {
                            return $model->idInmueble0->numero;
                        }
                    ],
                    [
                        'attribute'=>'idColono',
                        'value'=>function ($model) {
                            return Colonos::getFullName($model->idColono);
                        }
                    ],
                    'fechaRegistro:date',
                    'fechaSalidaColonia:date',
                    [
                        'attribute' => 'idUsuario',
                        'header' => 'Registrado por',
                        'value' => function ($model) {
                            return $model->idUsuario0->idColono0->nombre;
                        }
                    ],
                    [
                        'attribute' => 'estatus',
                        'value' => function ($model) {
                            return ucfirst($model->estatus);
                        }
                    ],
                    [
                        'attribute' => 'alCorriente',
                        'value' => function ($model) {
                            return ucfirst($model->alCorriente);
                        }
                    ],

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header' => 'Acciones',
                        'template' => '{pagos}',
                        'buttons' => [
                            'pagos' => function ($url, $model, $key) {
                                //TODO Implementar la acciona para lanzar el reporte
                                // de pagos de un inmueble dado
                                if (Yii::$app->session->get('tipo') == Usuarios::_ADMIN) {
                                    return Html::a(
                                        "<i class='fas fa-print'></i> ",
                                        [
                                            'pagos/reporte',
                                            'idInmuebleColono' => $model->id,
                                        ],
                                        [
                                            'title' => 'Imprimir',
                                            'data-toggle' => 'tooltip',
                                        ]
                                    );
                                }
                            },
                        ]
                    ],
                ],
            ]); ?>
        </div>
        </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->