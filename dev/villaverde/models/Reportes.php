<?php

namespace app\models;

use Yii;
use yii\base\Model;

class Reportes extends Model
{
    public $fechaInicial;
    public $fechaFinal;
    public $tipoFecha;
    
    public $idAreaReporte;
    public $idVehiculoReporte;
    public $idEjercicioReporte;

    public function rules()
    {
        return [
            [['idUsuario'],'integer'],

            [['fechaInicial', 'fechaFinal'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'fechaInicial'=>'fecha inicial',
            'fechaFinal'=>'fecha final',
        ];
    }

    public function formatosImpresion()
    {
        $arrFormatos=array(
            'pdf'=>'Pdf',
            'xls'=>'XLS'
        );

        return $arrFormatos;
    }
}


