<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Ejercicios;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ClientesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ejercicios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
  <div class="col-xs-12">
    <div class="box box-success">
      <div class="box-body">
        <div class="ejercicios-index">

            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    //['class' => 'yii\grid\SerialColumn'],
                    'numero',
                    //'fechaUltimoMovimiento:date',
                    [
                        'attribute' => 'idUsuario',
                        'header' => 'Registrado por',
                        'value' => function ($model) {
                            return $model->idUsuario0->idColono0->nombre;
                        }
                    ],
                    'observaciones',
                    [
                        'attribute'=>'estatus',
                        'value'=>function ($model) {
                            return ucfirst($model->estatus);
                        }
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header' => Html::a(
                            '<i class="glyphicon glyphicon-plus"></i>&nbsp;&nbsp;&nbsp;Nuevo',
                            ['create']
                        ),
                        'template' => '{activar}{desactivar}',
                        'buttons' => [
                            'activar' => function ($url, $model, $key) {
                                if ($model->estatus==Ejercicios::_INACTIVO) {
                                    return Html::a(
                                        "<i class='fa fa-check'></i>",
                                        [
                                            'activar',
                                            'id' => $model->id,
                                        ],
                                        [
                                            'title' => 'Activar',
                                            'data-toggle' => 'tooltip'
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