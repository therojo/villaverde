<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Chips".
 *
 * @property int $id
 * @property string $numero
 * @property string $estatus
 * @property string $placas
 * @property int $modelo
 * @property string $color
 * @property string $observaciones
 * @property string $createdAt
 * @property int $idInmuebleColono
 *
 * @property Autos $auto
 * @property InmueblesColonos $inmuebleColono
 */
class Chips extends \yii\db\ActiveRecord
{
    const _ACTIVO='activo';
    const _INACTIVO='inactivo';
    
    public $idInmueble;
    public $idCalle;
    public $idColono;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Chips';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['numero', 'idAuto', 'idInmuebleColono'], 'required'],
            [['estatus'], 'string'],
            [['createdAt'], 'safe'],
            [['numero'], 'string', 'max' => 10],
            [['observaciones'], 'string', 'max' => 100],
            [
                ['idInmuebleColono'],
                'exist',
                'skipOnError' => true,
                'targetClass' => InmueblesColonos::className(),
                'targetAttribute' => ['idInmuebleColono' => 'id']
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'numero' => 'Número',
            'estatus' => 'Estatus',
            'placas' => 'Placas',
            'modelo' => 'Modelo',
            'color' => 'Color',
            'observaciones' => 'Observaciones',
            'createdAt' => 'Fecha Registro',
            'idInmueble' => 'Inmueble',
            'idCalle' => 'Calle',
            'idColono' => 'idColono',
            'idInmuebleColono' => Yii::t('app', 'idInmuebleColono')
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInmuebleColono()
    {
        return $this->hasOne(InmueblesColonos::className(), ['id' => 'idInmuebleColono']);
    }

}
