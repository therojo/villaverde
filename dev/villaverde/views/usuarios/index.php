<?php

use app\models\Chips;
use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Colonos;
use app\models\Usuarios;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuariosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usuarios';
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
                        // 'id',
                        [
                            'attribute' => 'idColono',
                            'value' => function ($model) {
                                return ucfirst((new Colonos())->getFullName($model->idColono));
                            }
                        ],
                        'username',
                        'fechaRegistro:date',
                        [
                            'attribute'=>'estatus',
                            'value'=>function ($model) {
                                return ucfirst($model->estatus);
                            }
                        ],

                        [
                            'attribute'=> 'tipo',
                            'header'=>'Perfil',
                            'value'=> function($model){
                                return ucfirst($model->tipo);
                            }
                        ],

                        [
                            'class' => 'yii\grid\ActionColumn',
                            'header' => Html::a(
                                '<span class="glyphicon glyphicon-user"></span> &nbsp;Nuevo',
                                ['create']
                            ),
                            'template' => '{actualizar}{inactivar}{activar}',

                            'buttons' => [
                                'actualizar' => function ($url, $model, $key) {
                                    return Html::a(
                                        '<span class="glyphicon glyphicon-pencil"></span> ',
                                        [
                                            'update',
                                        ],
                                        [
                                            'title' => 'Actualizar',
                                            'data-toggle' => 'tooltip'
                                        ]
                                    );
                                },
                                'inactivar' => function ($url, $model, $key) {
                                    if ($model->estatus == Usuarios::_ACTIVO) {
                                        return Html::a(
                                            '<i class="fas fa-unlock"></i> ',
                                            [
                                                'inactivar',
                                            ],
                                            [
                                                'title' => 'Inactivar',
                                                'data-toggle' => 'tooltip'
                                            ]
                                        );
                                    }
                                },
                                'activar' => function ($url, $model, $key) {
                                    if ($model->estatus == Usuarios::_INACTIVO) {
                                        return Html::a(
                                            '<i class="fas fa-lock"></i> ',
                                            [
                                                'inactivar',
                                            ],
                                            [
                                                'title' => 'Inactivar',
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