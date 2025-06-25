<?php
use app\models\Colonos;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CambiosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="bloques-index">

    <?php
    
        if($dataProvider) {
         echo GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
             [
                'attribute'=> 'numero',
                'header'=>"Chip",
                'value'=> function($model){
                    return $model->numero;
                }
            ],
            [
                'attribute'=> 'idColono',
                'header'=>"Colono",
                'value'=> function($model){
                    return (new Colonos())->getFullName($model->idInmuebleColono0->idColono);                    
                }
            ],
           
            [
                'attribute'=> 'idInmuebleColono',
                'header'=>'Calle',
                'value'=> function($model){
                    return ucfirst($model->idInmuebleColono0->idInmueble0->idCalle0->nombre);
                }
            ],
            [
                'attribute'=> 'idInmuebleColono',
                'header'=>'Dirección',
                'value'=> function($model){
                    return ucfirst($model->idInmuebleColono0->idInmueble0->numero);
                }
            ],
            /*[
                'attribute'=> 'idAreaReporte',
                'value'=> function($model){
                    return $model->idInmuebleColono();
                }
            ]*/

            /* [
                'attribute'=> '',
                'value'=> function($model){
                    return ucfirst($model->);
                }
            ]*/
            
            //[
            //    'attribute'=>'idDependencia',
            //    'value'=>function ($model) {
            //        return $model->idDependencia0->nombre;
            //    }
            //],
            //'fechaEnvioJuridico:date',
        ],
    ]); 
    }
    ?>
</div>