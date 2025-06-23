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
    public $mesesParaBloqueo;

    public function rules()
    {
        return [
            [['idUsuario','mesesParaBloqueo '],'integer'],

            [['fechaInicial', 'fechaFinal','mesesParaBloqueo'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'fechaInicial'=>'fecha inicial',
            'fechaFinal'=>'fecha final',
            'mesesParaBloqueo' => 'Meses para bloqueo'
        ];
    }

    public function meses(){
        $meses = [
            1 => "D", 2 => "E",
            3 => "F", 4 => "G",
            5 => "H", 6 => "I",
            7 => "J", 8 => "K",
            9 => "L", 10 => "M",
            11 => "N",12 => "O",
            13 => "P"
        ];

        return $meses;

    }

    public function  matrizTotalesPorMes(){
        $totalesPorMes = [
            1 => 0, 2 => 0,
            3 => 0, 4 => 0,
            5 => 0, 6 => 0,
            7 => 0, 8 => 0,
            9 => 0, 10 => 0,
            11 => 0,12 => 0,
            13 => 0 
        ];

        return $totalesPorMes;
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


