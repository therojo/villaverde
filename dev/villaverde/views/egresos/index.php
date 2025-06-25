<?php

use app\models\Egresos;
use app\models\Usuarios;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
// use yii\grid\GridView;
use kartik\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\EgresosSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Egresos';
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- <p class="text-right">
    <?php  // Html::a('Nuevo  ', ['create'], ['class' => 'btn btn-success']) ?>
</p> -->

<div class="row">
  <div class="col-xs-12">
    <div class="box box-success">
        <div class="box-body">
            <div class="egresos-index">

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'showFooter' => true,
                    'showPageSummary' => true,
                    'columns' => [
                        //['class' => 'yii\grid\SerialColumn'],

                        // 'id',
                        'fecha',
                        [
                            'attribute'=> 'idPartida',
                            'value'=> function($model){
                                return ucfirst($model->idPartida0->nombre);
                            }
                        ],
                        'descripcion',
                        //'createdAt',
                        
                        [
                            'attribute'=> 'idUsuario',
                            'header'=> 'Registrado por',
                            'value'=> function($model){
                                return ucfirst($model->idUsuario0->idColono0->nombre);
                            }
                        ],
                        'estatus',
                        [
                            'attribute'=> 'total',
                            'value'=> function($model){
                                return $model->total;
                            },
                            'format'=>'currency',
                            'pageSummary' => true,
                            'hAlign' => GridView::ALIGN_RIGHT,
                        ],
                        
                        [
                            //'class' => 'yii\grid\ActionColumn',
                            'class' => 'kartik\grid\ActionColumn',
                            'header' => Html::a(
                                '<i class="fa fa-plus"></i> &nbsp;Nuevo',
                                ['create']
                            ),
                            'template' => '{cancelar}',
                            'buttons' => [
                                'cancelar' => function ($url, $model, $key) {
                                    if (Yii::$app->session->get('tipo') == Usuarios::_ADMIN) {
                                        return Html::a(
                                            '<span class="glyphicon glyphicon-trash"></span>',
                                            [
                                                'cancelar',
                                                'id' => $model->id,
                                            ],
                                            [
                                                'title' => 'Cancelar',
                                                'data-toggle' => 'tooltip',
                                                'data-confirm' => '¿ Esta seguro de cancelar este egreso'
                                            ]
                                        );
                                    }
                                },
                            ]
                        ]
                    ],
                ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>
