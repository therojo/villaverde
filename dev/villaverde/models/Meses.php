<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use DateTime;

/**
 * This is the model class for table "Meses".
 *
 * @property int $id
 * @property string $nombre
 *
 * @property Pagos[] $pagos
 */
class Meses extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Meses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['nombre'], 'string', 'max' => 10],
            [['nombre'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
        ];
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function lista()
    {
        $arr = ArrayHelper::map(
            Meses::find()
                ->orderBy('id')
                ->all(),
            'id',
            'nombre'
        );

        return $arr;
    }

    // Determinar siguiente mes/año a pagar, basado en una fecha dada

    function getNextMonthAndExercise($mes, $ejercicio) {
        
        // $mes = date("n",strtotime($fecha));
        // $anio = date("Y",strtotime($fecha));
        
        $anio = $ejercicio;

        if($mes <= 11) {
            $mes =$mes + 1;
        } else {
            $mes = 1;
            $anio = $anio + 1;
        }

        return ["mes" => $mes, "ejercicio" => $anio];

    }

    public function texto($mes) {

        $meses=[
                 1 => "Enero",
                 2 => "Febrero",
                 3 => "Marzo",
                 4 => "Abril",
                 5 => "Mayo",
                 6 => "Junio",
                 7 => "Julio",
                 8 => "Agosto",
                 9 => "Septiembre",
                10 => "Octubre",
                11 => "Noviembre",
                12 => "Diciembre",
        ];

        return $meses[$mes];
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getPagos()
    {
        return $this->hasMany(Pagos::className(), ['idMes' => 'id']);
    }
}
