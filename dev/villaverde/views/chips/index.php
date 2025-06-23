<?php

use app\models\Chips;
use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Colonos;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuariosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Chips';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
  <div class="col-xs-12">
    <div class="box box-success">
      <div class="box-body">
        <div class="chips-index">

            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        //['class' => 'yii\grid\SerialColumn'],
                        //'id',
                        'numero',
                        [
                            'attribute'=> 'idColono',
                            'value'=> function($model){
                                $colono =(new Colonos())->getFullName($model->idInmuebleColono0->idColono0->id);
                                return $colono;
                            }
                        ],
                        [
                            'attribute'=> 'idInmuebleColono',
                            'header'=>'Domicilio',
                            'value'=>function ($model) {
                                return $model->idInmuebleColono0->idInmueble0->fullAddress();
                            }
                        ],
                        [
                            'attribute'=> 'createdAt',
                            'value'=> function($model){
                                return $model->createdAt;
                            }
                        ],                        
                        'placas',
                        'modelo',
                        'color',
                        
                        [
                            'attribute'=> 'estatus',
                            'value'=> function($model){
                                return ucfirst($model->estatus);
                            }
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'header' => Html::a(
                                '<span class="glyphicon glyphicon-user"></span> &nbsp;Nuevo',
                                ['create']
                            ),
                            'template' => '{actualizar}',

                            'buttons' => [
                                'actualizar' => function ($url, $model, $key) {
                                    if ($model->estatus == Chips::_ACTIVO) {
                                        return Html::a(
                                            '<span class="glyphicon glyphicon-pencil"></span> ',
                                            [
                                                'update',
                                                'id'=>$model->id
                                            ],
                                            [
                                                'title' => 'Actualizar',
                                                'data-toggle' => 'tooltip'
                                            ]
                                        );
                                    }
                                },
                            ],
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