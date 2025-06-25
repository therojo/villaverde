<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Inmuebles".
 *
 * @property int $id
 * @property int $numero
 * @property string $numeroInterior
 * @property string $created_at
 * @property string $observaciones
 * @property string $asignado
 * @property string $tipo
 * @property int $idCalle
 * @property int $idUsuario
 *
 * @property InmueblesColonos[] $InmueblesColonos
 * @property Calles $calle
 * @property Usuarios $usuario
 */
class Inmuebles extends \yii\db\ActiveRecord
{
    
    /**
     * ENUM field values
     */
    const _ASIGNADO = 'si';
    const _NOASIGNADO = 'no';
    const TIPO_CASA = 'casa';
    const TIPO_TERRENO = 'terreno';
    const TIPO_BALDIO = 'baldio';

    public $idColonoActivo;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Inmuebles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['numero', 'idCalle', 'idUsuario'], 'required'],
            [['numero', 'idCalle', 'idUsuario'], 'integer'],
            [['idColonoActivo'], 'integer'], // Solo para mostrar que colono lo habita
            [['created_at'], 'safe'],
            ['asignado', 'in', 'range' => array_keys(self::optsAsignado())],
            [['tipo'], 'string'],
            [['numeroInterior'], 'string', 'max' => 45],
            [['observaciones'], 'string', 'max' => 150],
            // Validamos que no se repitan los domicilios, validar tambien num interno
            [
                ['idCalle'],
                'unique', 
                'message' => 'Este domicilio ya fue registrado',
                'targetAttribute' => ['idCalle', 'numero']
            ],
            [['idCalle'], 'exist', 'skipOnError' => true, 'targetClass' => Calles::className(), 'targetAttribute' => ['idCalle' => 'id']],
            [['idUsuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::className(), 'targetAttribute' => ['idUsuario' => 'id']],
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
            'numeroInterior' => 'Número Interior',
            'created_at' => 'Fecha Registro',
            'observaciones' => 'Observaciones',
            'asignado' => 'Asignado',
            'tipo' => 'Tipo',
            'idCalle' => Yii::t('app', 'idCalle'),
            'idUsuario' => Yii::t('app', 'idUsuario'),
        ];
    }

    /**
     * Obtener la direccion completa de un domicilio
     * Ejem Morelos 123 interior 2
     * @return void
     */
    public function fullAddress()
    {
        $domicilio=$this->idCalle0->nombre;
        $domicilio.=" ".$this->numero;

        if ($this->numeroInterior <> "") {
            $domicilio.=" ( int ".$this->numeroInterior.")";
        }

        return $domicilio;
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInmueblesColonos()
    {
        return $this->hasMany(InmueblesColonos::className(), ['idInmueble' => 'id']);
    }

    /**
     * column asignado ENUM value labels
     * @return string[]
     */
    public static function optsAsignado()
    {
        return [
            self::_ASIGNADO => 'si',
            self::_NOASIGNADO => 'no',
        ];
    }

    /**
     * column tipo ENUM value labels
     * @return string[]
     */
    public static function optsTipo()
    {
        return [
            self::TIPO_CASA => 'casa',
            self::TIPO_TERRENO => 'terreno',
            self::TIPO_BALDIO => 'baldio',
        ];
    }

    public function displayTipo()
    {
        return self::optsTipo()[$this->tipo];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCalle0()
    {
        return $this->hasOne(Calles::className(), ['id' => 'idCalle']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuario0()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'idUsuario']);
    }
}
