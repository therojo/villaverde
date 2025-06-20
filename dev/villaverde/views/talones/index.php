<?php

use yii\helpers\Html;
// use yii\grid\GridView;
use app\models\Colonos;
use app\models\Talones;
use app\models\Pagos;
use app\models\Usuarios;
use kartik\grid\GridView;
use yii\widgets\ActiveForm;
use app\models\InmueblesColonos;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PagosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

// $this->title = isset($contrato->id) ?'Contrato '.$contrato->folio." ( $". number_format($contrato->total, 2, '.', ',') ." )":"";

$this->title = "Talones de pago";

$this->params['breadcrumbs'][] = $this->title;

?>

<?php
$gridColumns = [
    // ['class' => 'yii\grid\SerialColumn'],
    // 'id',
    // [
    //     'attribute'=> 'ejercicio',
    //     'value'=> function($model){
    //         return ucfirst($model->ejercicio);
    //     },
    //     'hAlign' => GridView::ALIGN_CENTER,
    // ],
    [
        'attribute'=> 'numero',
        'value'=> function($model){
            return ucfirst($model->numero);
        },
        'hAlign' => GridView::ALIGN_CENTER,
    ],
    'created_at:date',
    'nombre',

    [
        'attribute'=> 'folioInicial',
        'value'=> function($model){
            return ucfirst($model->folioInicial);
        },
        'hAlign' => GridView::ALIGN_CENTER,
    ],
    [
        'attribute'=> 'folioFinal',
        'value'=> function($model){
            return ucfirst($model->folioFinal);
        },
        'hAlign' => GridView::ALIGN_CENTER,
    ],
    [
        'attribute'=> 'disponibles',
        'value'=> function($model){
            return  $model->folioFinal - (new Pagos())->recibosPorTalon($model);
        },
        'hAlign' => GridView::ALIGN_CENTER,
    ],
    
    'estatus',    
    [
        //'class' => 'yii\grid\ActionColumn',
        'class' => 'kartik\grid\ActionColumn',
        'header' => Html::a(
            '<i class="glyphicon glyphicon-plus"></i> &nbsp;Nuevo',
            ['create']
        ),
        'template' => '{update}{cerrar}{abrir}',
        'buttons' => [
            'cerrar' => function ($url, $model, $key) {
                if (Yii::$app->session->get('tipo') == Usuarios::_ADMIN
                    &&
                    $model->estatus == Talones::_ABIERTO
                ) {
                    //TODO hay que agregar idusuario apra ver quien tiene ese talon como responsable
                    return Html::a(
                        "<i class='fas fa-lock'></i> ",
                        [
                            'talones/cerrar',
                            'id' => $model->id,
                        ],
                        [
                            'title' => 'Cancelar',
                            'data-toggle' => 'tooltip',
                            'data-confirm' => '¿ Esta seguro de dar por cerrado este talon ?'
                        ]
                    );
                }
            },

            'abrir' => function ($url, $model, $key) {
                if (
                    Yii::$app->session->get('tipo') == Usuarios::_ADMIN
                    &&
                    $model->estatus==Talones::_CERRADO
                ) {
                    return Html::a(
                        " <i class='fas fa-lock-open'></i> ",
                        [
                            'talones/abrir',
                            'id' => $model->id,
                        ],
                        [
                            'title' => 'Abrir',
                            'data-toggle' => 'tooltip',
                            'data-confirm' => '¿ Esta seguro de abrir este talon ?'
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
