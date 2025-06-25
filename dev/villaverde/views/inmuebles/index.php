<?php

use app\models\InmueblesColonos;
use yii\helpers\Html;
// use yii\grid\GridView;
use kartik\grid\GridView;
use app\models\Colonos;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ClientesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Domicilios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
  <div class="col-xs-12">
    <div class="box box-success">
      <div class="box-body">
        <div class="clientes-index">

            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    //['class' => 'yii\grid\SerialColumn'],
                    //'id',
                    [
                        'attribute' => 'idCalle',
                        'value' => function ($model) {
                            return $model->idCalle0->nombre;
                        }
                    ],

                    [
                        'attribute'=> 'numero',
                        'value'=> function($model){
                            return ucfirst($model->numero);
                        },
                        'hAlign' => GridView::ALIGN_CENTER,
                        
                    ],
                    'numeroInterior',
                    [
                        'attribute'=> 'tipo',
                        'value'=> function($model){
                            return ucfirst($model->displayTipo());
                        }
                    ],
                    'created_at:date',
                    'observaciones',
                    // [
                    //     'attribute' => 'idUsuario',
                    //     'header'=>'Registrado por',
                    //     'value' => function ($model) {
                    //         return $model->idUsuario0->idColono0->nombre;
                    //     }
                    // ],
                    [
                        'attribute'=> 'asignado',
                        'value'=>function ($model) {
                            return ucfirst($model->asignado);
                        },
                        'hAlign' => GridView::ALIGN_CENTER,
                    ],
                    /*[
                        'attribute'=> 'idColonoActivo',
                        'header'=> 'Colono / Inquilino',    
                        'value'=> function($model){
                            
                            $inmuebleEnUso = (new InmueblesColonos())->buscarColonoActivo($model->id);
                            
                            if(isset($inmuebleEnUso->idColono)){
                                return (new Colonos())->getFullName($inmuebleEnUso->idColono);
                            } else {
                                return "";
                            }
                        }
                    ],*/
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header' => Html::a(
                            '<i class="glyphicon glyphicon-plus"></i>&nbsp;&nbsp;&nbsp;Nuevo',
                            ['create']
                        ),
                        // 'template' => '{actualizar}{bitacora}{cancelar}',
                        'template' => '{actualizar}',
                        'buttons' => [
                            'actualizar' => function ($url, $model, $key) {
                                return Html::a(
                                    '<span class="glyphicon glyphicon-pencil"></span> ',
                                    [
                                        'update',
                                        'id' => $model->id,
                                    ],
                                    [
                                        'title' => 'Actualizar',
                                        'data-toggle' => 'tooltip'
                                    ]
                                );
                            },
                            'bitacora' => function ($url, $model, $key) {
                                //TODO mostrar lista de que colonos han estado aqui
                                return Html::a(
                                    "<i class='fas fa-bars'></i> ",
                                    [
                                        'inmueble-colonos/bitacora',
                                        'idInmueble' => $model->id,
                                    ],
                                    [
                                        'title' => 'Bitacora',
                                        'data-toggle' => 'tooltip'
                                    ]
                                );
                            },
                            'cancelar' => function ($url, $model, $key) {
                                return Html::a(
                                    '<span class="glyphicon glyphicon-remove"></span> ',
                                    [
                                        'cancelar',
                                        'id' => $model->id,
                                    ],
                                    [
                                        'title' => 'Eliminar',
                                        'data-toggle' => 'tooltip',
                                        'data-confirm' => '¿ Esta seguro de cancelar inmueble ?'
                                    ]
                                );
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